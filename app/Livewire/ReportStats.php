<?php

namespace App\Livewire;

use App\Models\DailyReportAssignUser;
use Livewire\Component;
use Carbon\Carbon;

class ReportStats extends Component
{
    public $selectedDay;
    public $reports;

    public function mount()
    {
        $this->selectedDay = 'now';
        $this->reports = [];
        $this->loadReports();
    }

    public function updatedSelectedDay()
    {
        $this->loadReports();
    }

    public function loadReports()
    {
        $query = DailyReportAssignUser::query();

        if ($this->selectedDay == 'now') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($this->selectedDay == 'prev') {
            $query->whereDate('created_at', Carbon::yesterday());
        } elseif ($this->selectedDay == 'next') {
            $query->whereDate('created_at', Carbon::tomorrow());
        } elseif ($this->selectedDay == 'week') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }

        // جلب البيانات وتنسيق التاريخ
        $this->reports = $query->get()->map(function ($report) {
            $report->formatted_date = Carbon::parse($report->created_at)->translatedFormat('d F Y'); // تنسيق بالعربية
            return $report;
        });
    }


    public function render()
    {
        return view('livewire.report-stats');
    }
}
