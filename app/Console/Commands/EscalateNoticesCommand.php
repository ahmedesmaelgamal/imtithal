<?php

namespace App\Console\Commands;

use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EscalateNoticesCommand extends Command
{
    protected $signature = 'notices:escalate';
    protected $description = 'Escalate notices based on their type period';

    public function handle()
    {
        $this->info('Starting notice escalation process...');

        $notices = Notice::with('noticeType')
            ->where('status', '0')
            ->where('is_up', false)
            ->get();

        $escalatedCount = 0;

        foreach ($notices as $notice) {
            // Skip if noticeType or period is null
            if (!$notice->noticeType || !$notice->noticeType->period) {
                $this->line("Notice ID: {$notice->id} skipped - no notice type or period defined");
                continue;
            }

            $minutesDiff = Carbon::parse($notice->created_at)->diffInMinutes(now());
            $escalationPeriod = (int) $notice->noticeType->period;
            $this->line('Notice ID: ' . $notice->id .'created at: ' . $notice->created_at. ' - Minutes since creation: ' . $minutesDiff.' - Escalation period: ' .$escalationPeriod);

            if ($escalationPeriod !== null && $minutesDiff >= $escalationPeriod) {
                $notice->update([
                    'is_up' => true,
                    'status' => '3'
                ]);

                $escalatedCount++;
                $this->line("Escalated notice ID: {$notice->id}");
            }
        }

        $this->info("Completed! Escalated {$escalatedCount} notices.");
        return 0;
    }

    protected function getEscalationPeriodInMinutes(?string $period): ?int
    {
        if ($period === null) {
            return null;
        }

        return match ($period) {
            'after 24 hours' => 24 * 60,
            'after 48 hours' => 48 * 60,
            'live' => 0,
            'none' => null,
            default => null,
        };
    }
}
