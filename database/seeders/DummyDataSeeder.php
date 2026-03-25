<?php

namespace Database\Seeders;

use App\Enum\AreaTypeEnum;
use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\TaskQuestionEnum;
use App\Models\ActivityLog;
use App\Models\Admin;
use App\Models\AgoraChannel;
use App\Models\Alert;
use App\Models\AlertLeader;
use App\Models\AlertUser;
use App\Models\Area;
use App\Models\AreaLocation;
use App\Models\AreaPoint;
use App\Models\AreaTeam;
use App\Models\Attendance;
use App\Models\Axis;
use App\Models\AxisQuestion;
use App\Models\BusReport;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReport;
use App\Models\DailyReportAssign;
use App\Models\DailyReportAssignUser;
use App\Models\DeviceToken;
use App\Models\GeneralReport;
use App\Models\Media;
use App\Models\Notice;
use App\Models\NoticeType;
use App\Models\Notification;
use App\Models\PolicyPrivacy;
use App\Models\QuestionAnswer;
use App\Models\Room;
use App\Models\RoomMessage;
use App\Models\Season;
use App\Models\Setting;
use App\Models\SupportChat;
use App\Models\SupportChatMessage;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use App\Models\User;
use App\Models\Trip;
use App\Models\UserSetting;
use App\Models\ViolationReport;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('en_US');

        $season = Season::query()->updateOrCreate(
            ['id' => 1],
            ['name' => 'Demo Season', 'status' => 1]
        );
        Season::query()->where('id', '!=', $season->id)->update(['status' => 0]);

        if (Admin::query()->count() < 10) {
            Admin::factory(10 - Admin::query()->count())->create();
        }
        $admins = Admin::query()->get();




        $mainUsers = [
            "admin" => [
                'full_name' => 'مدير النظام',
                'national_id' => '1234567899',
                'phone' => '1234567899',
                'email' => 'admin@admin.com',
                'image' => $faker->imageUrl(200, 200, 'people'),
                'fcm_token' => $faker->uuid,
                'jwt_token' => $faker->uuid,
                'password' => Hash::make('123456789'),
                'otp' => null,
                'otp_expire' => null,
                'status' => 1,
                'delete_reason' => null,
            ],
            "monitor" => [
                'full_name' => 'مراقب',
                'national_id' => '1234567800',
                'phone' => '1234567800',
                'email' => 'monitor@admin.com',
                'image' => $faker->imageUrl(200, 200, 'people'),
                'fcm_token' => $faker->uuid,
                'jwt_token' => $faker->uuid,
                'password' => Hash::make('123456789'),
                'otp' => null,
                'otp_expire' => null,
                'status' => 1,
                'delete_reason' => null,
            ],
            "supervisor" => [
                'full_name' => 'مشرف',
                'national_id' => '1234567811',
                'phone' => '1234567811',
                'email' => 'supervisor@admin.com',
                'image' => $faker->imageUrl(200, 200, 'people'),
                'fcm_token' => $faker->uuid,
                'jwt_token' => $faker->uuid,
                'password' => Hash::make('123456789'),
                'otp' => null,
                'otp_expire' => null,
                'status' => 1,
                'delete_reason' => null,
            ]
        ];

        User::create($mainUsers['monitor'])->assignRole('مراقب');
        User::create($mainUsers['supervisor'])->assignRole('مشرف');


        $users = User::factory(60)->create();

        foreach ($users as $index => $user) {
            $role = ($index < 30) ? 'مشرف' : 'مراقب';
            $user->assignRole($role);
        }

        // Settings + user setting links
        if (Setting::query()->count() < 3) {
            for ($i = 1; $i <= 3; $i++) {
                Setting::query()->create([
                    'name' => "Setting {$i}",
                    'code' => "setting_{$i}",
                    'checkin_date' => '08:00:00',
                    'checkout_date' => '17:00:00',
                    'checkin_max_date' => '09:00:00',
                    'checkout_max_date' => '18:00:00',
                    'north' => (string) $faker->latitude(21.20, 21.70),
                    'south' => (string) $faker->latitude(21.10, 21.50),
                    'east' => (string) $faker->longitude(39.60, 40.10),
                    'west' => (string) $faker->longitude(39.30, 39.90),
                    'location_url' => 'https://maps.google.com',
                ]);
            }
        }
        $settings = Setting::query()->get();
        foreach ($users as $user) {
            $selectedSettingIds = $settings->random(random_int(1, min(2, $settings->count())))->pluck('id');
            foreach ($selectedSettingIds as $settingId) {
                UserSetting::query()->firstOrCreate([
                    'user_id' => $user->id,
                    'setting_id' => $settingId,
                ]);
            }
        }

        // Axes + questions + question answers
        $axes = Axis::factory(8)->create();
        $axisQuestions = collect();
        foreach ($axes as $axis) {
            for ($order = 1; $order <= 6; $order++) {
                $answerType = (string) $faker->randomElement(TaskQuestionEnum::values());
                $question = AxisQuestion::query()->create([
                    'question' => $faker->sentence(8),
                    'axis_id' => $axis->id,
                    'answer_type' => $answerType,
                    'require_file' => (string) random_int(0, 1),
                    'order_number' => $order,
                    'true_parent_id' => null,
                    'false_parent_id' => null,
                ]);

                if ((int) $answerType === TaskQuestionEnum::MULTIPLE->value) {
                    for ($a = 1; $a <= 4; $a++) {
                        QuestionAnswer::query()->create([
                            'axis_question_id' => $question->id,
                            'answer' => "Option {$a}",
                        ]);
                    }
                }
                $axisQuestions->push($question);
            }
        }

        // Main Areas
        $mainAreas = collect();
        $accomodations = [
            "مساكن مكه",
            "مساكن المدينه",
            "مطار مكه",
            "مطار المدينه",
        ];

        foreach ($accomodations as $name) {
            $mainAreas->push(Area::create([
                "name" => $name,
                'location' => $faker->city,
                'latitude' => (string) $faker->latitude(21.20, 21.70),
                'longitude' => (string) $faker->longitude(39.40, 40.00),
                'status' => 1,
                'season_id' => $season->id,
                'type' => 'main'
            ]));
        }

        // Areas + locations + points + teams
        $areas = collect();
        foreach ($axes as $axis) {
            for ($i = 1; $i <= 3; $i++) {
                $area = Area::query()->create([
                    'name' => "{$axis->name} Area {$i}",
                    'type' => 'sub',
                    'parent_id' => $mainAreas->random()->id,
                    'season_id' => $season->id,
                ]);
                $areas->push($area);

                AreaLocation::query()->create([
                    'area_id' => $area->id,
                    'north' => (string) $faker->latitude(21.30, 21.65),
                    'south' => (string) $faker->latitude(21.20, 21.45),
                    'east' => (string) $faker->longitude(39.80, 40.00),
                    'west' => (string) $faker->longitude(39.50, 39.75),
                ]);

                AreaPoint::query()->create([
                    'area_id' => $area->id,
                    'start_point_lat' => (string) $faker->latitude(21.30, 21.60),
                    'start_point_long' => (string) $faker->longitude(39.60, 39.95),
                    'end_point_lat' => (string) $faker->latitude(21.30, 21.60),
                    'end_point_long' => (string) $faker->longitude(39.60, 39.95),
                ]);

                $teamUsers = $users->random(5)->values();
                AreaTeam::query()->create([
                    'area_id' => $area->id,
                    'user_id' => $teamUsers[0]->id,
                    'type' => 1,
                    'primary_leader' => 1,
                ]);
                AreaTeam::query()->create([
                    'area_id' => $area->id,
                    'user_id' => $teamUsers[1]->id,
                    'type' => 1,
                    'primary_leader' => 0,
                ]);
                foreach ([$teamUsers[2], $teamUsers[3], $teamUsers[4]] as $member) {
                    AreaTeam::query()->create([
                        'area_id' => $area->id,
                        'user_id' => $member->id,
                        'type' => 0,
                        'primary_leader' => 0,
                    ]);
                }
            }
        }

        // Daily reports + assignments + answers
        $dailyReports = collect();
        foreach (range(1, 20) as $i) {
            $axis = $axes->random();
            $dailyReport = DailyReport::query()->create([
                'title' => "Daily Report {$i}",
                'description' => $faker->paragraph(3),
                'axis_id' => $axis->id,
                'monitor_type' => (string) random_int(0, 2),
                'side_type' => (string) random_int(0, 14),
                'deadline' => now()->addDays(random_int(1, 14))->toDateString(),
            ]);
            $dailyReports->push($dailyReport);

            DailyReportAssign::query()->create([
                'daily_report_id' => $dailyReport->id,
                'deadline' => now()->addDays(random_int(1, 14))->toDateString(),
            ]);

            $area = $areas->random();
            $leaderId = AreaTeam::query()
                ->where('area_id', $area->id)
                ->where('type', 1)
                ->inRandomOrder()
                ->value('user_id') ?? $users->random()->id;

            $assignedUsers = $users->where('id', '!=', $leaderId)->random(3);
            foreach ($assignedUsers as $assignedUser) {
                $assignUser = DailyReportAssignUser::query()->create([
                    'daily_report_id' => $dailyReport->id,
                    'user_id' => $assignedUser->id,
                    'deadline' => now()->addDays(random_int(1, 14))->toDateString(),
                    'status' => (string) random_int(0, 4),
                    'axis_id' => $axis->id,
                    'area_id' => $area->id,
                    'leader_id' => $leaderId,
                ]);

                $questionsForAxis = $axisQuestions->where('axis_id', $axis->id)->take(4);
                foreach ($questionsForAxis as $question) {
                    $pickedAnswer = QuestionAnswer::query()
                        ->where('axis_question_id', $question->id)
                        ->inRandomOrder()
                        ->first();

                    DailyAssignUserAnswer::query()->create([
                        'daily_report_assign_user_id' => $assignUser->id,
                        'axis_question_id' => $question->id,
                        'answer' => $faker->sentence(6),
                        'question_answer_id' => $pickedAnswer?->id,
                        'status' => (string) random_int(0, 2),
                        'user_id' => $assignedUser->id,
                        'refuse_reason' => (string) $faker->optional()->randomElement(DailyReportRejectReasonEnum::values()),
                        'refuse_notice' => $faker->optional()->sentence(8),
                    ]);
                }
            }
        }

        // Alerts + mappings
        $alerts = collect();
        foreach (range(1, 30) as $i) {
            $leader = $users->random();
            $admin = $admins->random();
            $to = (string) random_int(0, 2);

            $alert = Alert::query()->create([
                'title' => "Alert {$i}",
                'body' => $faker->paragraph(2),
                'type' => $faker->randomElement(['alert', 'notification', 'reminder']),
                'leader_id' => $leader->id,
                'admin_id' => $admin->id,
                'to' => $to,
                'priority' => $faker->randomElement(['low', 'mid', 'high']),
                'notification_type' => $faker->randomElement(['system', 'task', 'warning']),
                'user_type' => $faker->randomElement(['other', 'leader']),
            ]);
            $alerts->push($alert);

            foreach ($users->random(3) as $user) {
                AlertUser::query()->create([
                    'user_id' => $user->id,
                    'alert_id' => $alert->id,
                    'seen' => random_int(0, 1),
                ]);
            }

            AlertLeader::query()->create([
                'alert_id' => $alert->id,
                'leader_id' => $leader->id,
                'seen' => random_int(0, 1),
            ]);
        }

        // Notice types + notices
        foreach (range(1, 10) as $i) {
            NoticeType::query()->create([
                'name' => "Notice Type {$i}",
                'priority' => $faker->randomElement(['suggest', 'low', 'mid', 'high']),
                'period' => $faker->randomElement(['none', 'after 24 hours', 'after 48 hours', 'live']),
                'level' => null,
            ]);
        }
        $noticeTypes = NoticeType::query()->get();

        foreach (range(1, 50) as $i) {
            $status = (string) random_int(0, 3);
            Notice::query()->create([
                'notice_type_id' => $noticeTypes->random()->id,
                'suggestion_title' => $faker->boolean(20) ? $faker->words(3, true) : null,
                'lat' => (string) $faker->latitude(21.20, 21.70),
                'long' => (string) $faker->longitude(39.40, 40.00),
                'description' => $faker->paragraph(2),
                'notice_time' => now()->format('H:i:s'),
                'notice_date' => now()->toDateString(),
                'user_id' => $users->random()->id,
                'status' => $status,
                'is_up' => $status === '3' ? 1 : 0,
                'refuse_reason' => $status === '2' ? (string) random_int(1, 20) : null,
                'refuse_notice' => $status === '2' ? $faker->sentence(8) : null,
                'admin_id' => $admins->random()->id,
                'leader_id' => $users->random()->id,
                'user_type' => random_int(0, 1),
            ]);
        }

        // Reports
        foreach (range(1, 35) as $i) {
            $status = (string) random_int(0, 2);
            GeneralReport::query()->create([
                'title' => "General Report {$i}",
                'description' => $faker->paragraph(3),
                'extra' => $faker->optional()->sentence(10),
                'leader_id' => $users->random()->id,
                'admin_id' => $admins->random()->id,
                'status' => $status,
                'refuse_reason' => $status === '2' ? (string) random_int(1, 20) : null,
                'refuse_notes' => $status === '2' ? $faker->sentence(10) : null,
            ]);
        }

        foreach (range(1, 35) as $i) {
            $status = (string) random_int(0, 2);
            ViolationReport::query()->create([
                'title' => "Violation Report {$i}",
                'description' => $faker->paragraph(3),
                'reference_number' => 'VR-' . Str::upper(Str::random(8)),
                'violation_time' => now()->format('H:i:s'),
                'violation_date' => now()->toDateString(),
                'map_url' => 'https://maps.google.com',
                'lat' => (string) $faker->latitude(21.20, 21.70),
                'long' => (string) $faker->longitude(39.40, 40.00),
                'plate_number' => strtoupper($faker->bothify('???####')),
                'plate_letter_ar' => 'A',
                'plate_letter_en' => 'A',
                'plate_image' => null,
                'vehicle_type' => $faker->randomElement(['car', 'bus', 'truck']),
                'violation_image' => null,
                'violation_video' => null,
                'user_id' => $users->random()->id,
                'admin_id' => $admins->random()->id,
                'user_type' => (string) random_int(0, 1),
                'status' => $status,
                'refuse_reason' => $status === '2' ? (string) random_int(1, 20) : null,
                'refuse_notes' => $status === '2' ? $faker->sentence(10) : null,
            ]);
        }

        // Attendance
        foreach ($users as $user) {
            foreach (range(0, 4) as $dayOffset) {
                $date = now()->subDays($dayOffset);
                Attendance::query()->create([
                    'user_id' => $user->id,
                    'checkin' => $date->copy()->setTime(8, random_int(0, 30)),
                    'checkout' => $date->copy()->setTime(17, random_int(0, 30)),
                    'checkin_lat' => (string) $faker->latitude(21.20, 21.70),
                    'checkin_long' => (string) $faker->longitude(39.40, 40.00),
                    'date' => $date->toDateString(),
                    'checkout_lat' => (string) $faker->latitude(21.20, 21.70),
                    'checkout_long' => (string) $faker->longitude(39.40, 40.00),
                ]);
            }
        }

        // Rooms + room messages + agora channels
        $rooms = collect();
        foreach (range(1, 20) as $i) {
            [$fromUser, $toUser] = $this->pickTwoUsers($users);
            $room = Room::query()->create([
                'from_user_id' => $fromUser->id,
                'to_user_id' => $toUser->id,
            ]);
            $rooms->push($room);

            foreach (range(1, 5) as $m) {
                RoomMessage::query()->create([
                    'room_id' => $room->id,
                    'from_user_id' => $m % 2 === 0 ? $fromUser->id : $toUser->id,
                    'to_user_id' => $m % 2 === 0 ? $toUser->id : $fromUser->id,
                    'message' => $faker->sentence(8),
                    'voice' => null,
                    'file' => null,
                ]);
            }

            AgoraChannel::query()->firstOrCreate(
                ['channel_name' => "room_channel_{$room->id}"],
                [
                    'from_user_id' => $fromUser->id,
                    'to_user_id' => (string) $toUser->id,
                    'token' => Str::random(48),
                ]
            );
        }

        // Support chats + messages
        foreach (range(1, 15) as $i) {
            [$fromUser, $toUser] = $this->pickTwoUsers($users);
            $chat = SupportChat::query()->create([
                'user_id' => $fromUser->id,
                'admin_id' => $toUser->id, // constrained to users in this schema
            ]);

            foreach (range(1, 4) as $m) {
                SupportChatMessage::query()->create([
                    'support_chat_id' => $chat->id,
                    'from_user_id' => $m % 2 === 0 ? $fromUser->id : $toUser->id,
                    'to_user_id' => $m % 2 === 0 ? $toUser->id : $fromUser->id,
                    'message' => $faker->sentence(7),
                    'voice' => null,
                    'file' => null,
                ]);
            }
        }

        // Support tickets + replies
        foreach (range(1, 25) as $i) {
            $ticket = SupportTicket::query()->create([
                'user_id' => $users->random()->id,
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
                'subject' => "Support Ticket {$i}",
                'message' => $faker->paragraph(2),
                'status' => random_int(0, 1),
            ]);

            SupportTicketReply::query()->create([
                'support_ticket_id' => $ticket->id,
                'admin_id' => $admins->random()->id,
                'user_id' => null,
                'reply' => $faker->sentence(10),
            ]);

            SupportTicketReply::query()->create([
                'support_ticket_id' => $ticket->id,
                'admin_id' => null,
                'user_id' => $ticket->user_id,
                'reply' => $faker->sentence(10),
            ]);
        }

        // Bus reports
        foreach (range(1, 25) as $i) {
            BusReport::query()->create([
                'area_id' => $areas->random()->id,
                'user_id' => $users->random()->id,
                'bus_count' => random_int(1, 50),
                'end_time' => now()->addHours(random_int(1, 8)),
            ]);
        }

        // Policies
        foreach (['policy', 'privacy'] as $idx => $label) {
            PolicyPrivacy::query()->create([
                'title' => ucfirst($label),
                'body' => $faker->paragraph(4),
                'type' => (string) $idx,
            ]);
        }

        // Notifications + device tokens
        foreach ($admins as $admin) {
            DeviceToken::query()->create([
                'token' => Str::random(64),
                'admin_id' => $admin->id,
            ]);

            foreach (range(1, 2) as $n) {
                Notification::query()->create([
                    'title' => "System Notification {$n}",
                    'body' => $faker->sentence(12),
                    'admin_id' => $admin->id,
                ]);
            }
        }

        // Media attachments across different morph models
        $this->seedMediaForModel($faker, Notice::query()->limit(20)->get(), Notice::class, 'image');
        $this->seedMediaForModel($faker, GeneralReport::query()->limit(15)->get(), GeneralReport::class, 'image');
        $this->seedMediaForModel($faker, ViolationReport::query()->limit(15)->get(), ViolationReport::class, 'image');
        $this->seedMediaForModel($faker, DailyAssignUserAnswer::query()->limit(20)->get(), DailyAssignUserAnswer::class, 'file');

        // Activity logs
        $modelTargets = [
            ['type' => Notice::class, 'ids' => Notice::query()->pluck('id')],
            ['type' => GeneralReport::class, 'ids' => GeneralReport::query()->pluck('id')],
            ['type' => ViolationReport::class, 'ids' => ViolationReport::query()->pluck('id')],
            ['type' => DailyReport::class, 'ids' => $dailyReports->pluck('id')],
        ];
        foreach (range(1, 60) as $i) {
            $target = $faker->randomElement($modelTargets);
            /** @var Collection $ids */
            $ids = $target['ids'];
            if ($ids->isEmpty()) {
                continue;
            }

            $event = $faker->randomElement(['create', 'update', 'delete']);
            ActivityLog::query()->create([
                'admin_id' => $admins->random()->id,
                'event' => $event,
                'model_type' => $target['type'],
                'model_id' => $ids->random(),
                'description' => ucfirst($event) . ' operation for demo data',
                'old_data' => ['before' => Str::random(8)],
                'new_data' => ['after' => Str::random(8)],
                'ip_address' => $faker->ipv4,
            ]);
        }



        $trips = [
            "رحلة مكه",
            "رحلة المدينه",
            "رحلة جده",
            "رحلة الرياض",
            "رحلة الدمام",
            "رحلة الخبر",
            "رحلة الاحساء",
            "رحلة الطائف",
            "رحلة الباحة",
            "رحلة عسير",
        ];

        foreach ($trips as $index => $tripName) {
            Trip::create([
                'trip_number' => 'T-' . rand(1000, 9999),
                'air_carrier' => $faker->company,
                'departure_country' => $faker->country,
                'readiness_list_number' => 'R-' . rand(10000, 99999),
                'service_provider' => $faker->company,
                'hajj_groups_count' => rand(1, 15),
                'hajjis_count' => rand(20, 200),
                'area_id' => Area::inRandomOrder()->first()?->id,
                'arrival_date' => $faker->date(),
                'arrival_time' => $faker->time('H:i'),
                'executor' => $faker->name,
                'contract_number' => 'C-' . rand(1000, 9999),
                'residence_city' => $faker->city,
            ]);
        }
    }

    private function pickTwoUsers(Collection $users): array
    {
        $pair = $users->random(2)->values();
        return [$pair[0], $pair[1]];
    }

    private function seedMediaForModel($faker, Collection $records, string $modelClass, string $type): void
    {
        foreach ($records as $record) {
            Media::query()->create([
                'file' => '/dummy/' . Str::uuid() . '.png',
                'file_type' => $type,
                'file_name' => 'demo_' . Str::random(8),
                'model_type' => $modelClass,
                'model_id' => $record->id,
            ]);
        }
    }
}
