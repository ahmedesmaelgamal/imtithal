<?php
//
//namespace App\Console\Commands;
//
//use Illuminate\Console\Command;
//use GuzzleHttp\Client;
//use Carbon\Carbon;
//use Illuminate\Support\Facades\Log;
//
//class UpdateIsActive extends Command
//{
//    protected $signature = 'firestore:deactivate-stale-users';
//    protected $description = 'Deactivate Firestore users whose updated_at is older than 3 minutes';
//
//    protected Client $client;
//
//    public function handle(): void
//    {
//        $this->line('Checking for stale Firestore users...');
//
//        $staleUsers = $this->getStaleUsersFromFirestore();
//
//        if (empty($staleUsers)) {
//            $this->info('No stale users found.');
//            return;
//        }
//
//        foreach ($staleUsers as $user) {
//            $documentName = $user['document']['name'];
//
//            $this->updateUserInFirestore($documentName);
//            $this->line("Deactivated user: {$documentName}");
//        }
//
//        $this->info('Finished updating stale users.');
//    }
//
//    /**
//     * Query Firestore for users with updated_at older than 3 minutes.
//     */
//    protected function getStaleUsersFromFirestore(): array
//    {
//        $this->client = new Client([
//            'base_uri' => 'https://firestore.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_ID') . '/databases/(default)/documents/',
//        ]);
//
//        $threeMinutesAgo = Carbon::now()->subMinutes(3)->toRfc3339String();
//
//        $body = [
//            'structuredQuery' => [
//                'from' => [['collectionId' => 'users']],
//                'where' => [
//                    'fieldFilter' => [
//                        'field' => ['fieldPath' => 'updated_at'],
//                        'op' => 'LESS_THAN',
//                        'value' => [
//                            'timestampValue' => $threeMinutesAgo,
//                        ],
//                    ],
//                ],
//            ],
//        ];
//
//        try {
//            $response = $this->client->post(':runQuery', ['json' => $body]);
//            $results = json_decode($response->getBody()->getContents(), true);
//
//            return array_filter($results, fn($doc) => isset($doc['document']));
//        } catch (\Exception $e) {
//            Log::error('Error querying Firestore: ' . $e->getMessage());
//            return [];
//        }
//    }
//
//    /**
//     * Update Firestore user document to set is_active = false.
//     */
//    protected function updateUserInFirestore(string $documentName): void
//    {
//        try {
//            $this->client->patch($documentName . '?updateMask.fieldPaths=is_active', [
//                'json' => [
//                    'fields' => [
//                        'is_active' => [
//                            'booleanValue' => false,
//                        ],
//                        'updated_at' => [
//                            'timestampValue' => Carbon::now()->toRfc3339String(),
//                        ],
//                    ],
//                ],
//            ]);
//        } catch (\Exception $e) {
//            Log::error("Failed to update user {$documentName}: " . $e->getMessage());
//        }
//    }
//}

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateIsActive extends Command
{
    protected $signature = 'firestore:deactivate-stale-users';
    protected $description = 'Deactivate Firestore users whose updated_at is older than 3 minutes';

    protected Client $client;

    public function handle(): void
    {
        $this->line('Checking for stale Firestore users...');
        $this->initializeFirestoreClient();

        $staleUsers = $this->getStaleUsersFromFirestore();

        if (empty($staleUsers)) {
            $this->info('No stale users found.');
            return;
        }

        $this->info('Found ' . count($staleUsers) . ' stale users to update.');

        foreach ($staleUsers as $user) {
            $documentPath = $this->extractDocumentPath($user['document']['fields']['national_id']['stringValue']);
            $this->updateUserInFirestore($documentPath);
            $this->line("Deactivated user: {$documentPath}");
        }

        $this->info('Finished updating stale users.');
    }

    protected function initializeFirestoreClient(): void
    {
        $this->client = new Client([
            'base_uri' => 'https://firestore.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_ID') . '/databases/(default)/documents/',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    protected function extractDocumentPath(string $fullDocumentName): string
    {
        return $fullDocumentName;
    }

    protected function getStaleUsersFromFirestore(): array
    {
        $threeMinutesAgo = Carbon::now()->subMinutes(3)->toRfc3339String();

        $body = [
            'structuredQuery' => [
                'from' => [['collectionId' => 'users']],
                'where' => [
                    'fieldFilter' => [
                        'field' => ['fieldPath' => 'updated_at'],
                        'op' => 'LESS_THAN',
                        'value' => ['timestampValue' => $threeMinutesAgo],
                    ],
                ],
            ],
        ];

        try {
            $response = $this->client->post(':runQuery', ['json' => $body]);
            $results = json_decode($response->getBody()->getContents(), true);

            return array_filter($results, fn($doc) => isset($doc['document']));
        } catch (\Exception $e) {
            Log::error('Error querying Firestore: ' . $e->getMessage());
            $this->error('Firestore query failed: ' . $e->getMessage());
            return [];
        }
    }

    protected function updateUserInFirestore(string $documentPath): void
    {
        try {
            $response = $this->client->patch('users/'.$documentPath.'?updateMask.fieldPaths=is_active&updateMask.fieldPaths=updated_at', [
                'json' => [
                    'fields' => [
                        'is_active' => ['booleanValue' => false],
                        'updated_at' => ['timestampValue' => Carbon::now()->toRfc3339String()],
                    ],
                ],
            ]);

            $this->info("Successfully updated: {$documentPath}");
        } catch (\Exception $e) {
            $this->handleUpdateError($documentPath, $e);
        }
    }

    protected function handleUpdateError(string $documentPath, \Exception $e): void
    {
        $this->error("Update failed for {$documentPath}: " . $e->getMessage());

        if (method_exists($e, 'getResponse')) {
            $response = $e->getResponse();
            if ($response) {
                $this->error('Status: ' . $response->getStatusCode());
                $this->error('Body: ' . $response->getBody()->getContents());
            }
        }
    }
}