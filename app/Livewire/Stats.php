<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\GeneralReport;
use App\Models\Notice;
use App\Models\User;
use App\Models\ViolationReport;
use Livewire\Component;
use App\Models\DailyReportAssignUser; // تأكد من استيراد الموديل المناسب
use Carbon\Carbon;

class Stats extends Component
{
    public int $dailyReport = 0;
    public int $dailyGrowthPercentage = 0;

    public int $users = 0;
    public int $userGrowthPercentage = 0;

    public int $reports = 0;
    public int $reportGrowthPercentage = 0;

    public int $areas = 0;
    public int $areaGrowthPercentage = 0;

    public function mount()
    {
        $this->updateDailyReport();
        $this->updateUsers();
        $this->updateReports();
        $this->updateAreas();
    }

    public function updateDailyReport()
    {
        $dailyReportCount = DailyReportAssignUser::whereDate('created_at', Carbon::now())->count();
        $yesterdayDailyReport = DailyReportAssignUser::whereDate('created_at', Carbon::yesterday())->count();

        $this->dailyReport = DailyReportAssignUser::count();

        if ($yesterdayDailyReport > 0) {
            $this->dailyGrowthPercentage = (($dailyReportCount - $yesterdayDailyReport) / $yesterdayDailyReport) * 100;
        } else {
            $this->dailyGrowthPercentage = $dailyReportCount > 0 ? 100 : 0;
        }

        // Clamp the percentage between 0 and 100
        if ($this->dailyGrowthPercentage > 100) {
            $this->dailyGrowthPercentage = 100;
        } elseif ($this->dailyGrowthPercentage < 0) {
            $this->dailyGrowthPercentage = 0;
        }
    }

    public function updateUsers()
    {
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $yesterdayUsers = User::whereDate('created_at', Carbon::yesterday())->count();

        $this->users = User::count();; // إجمالي عدد المستخدمين

        // حساب نسبة الزيادة (تجنب القسمة على صفر)
        if ($yesterdayUsers > 0) {
            $this->userGrowthPercentage = (($todayUsers - $yesterdayUsers) / $yesterdayUsers) * 100;
        } else {
            $this->userGrowthPercentage = $todayUsers > 0 ? 100 : 0;
        }

        // Clamp the percentage between 0 and 100
        if ($this->userGrowthPercentage > 100) {
            $this->userGrowthPercentage = 100;
        } elseif ($this->userGrowthPercentage < 0) {
            $this->userGrowthPercentage = 0;
        }
    }


    public function updateReports()
    {
        $todayReports = Notice::whereDate('created_at', Carbon::today())->count();
        $yesterdayReports = Notice::whereDate('created_at', Carbon::yesterday())->count();

        $this->reports = Notice::count();

        if ($yesterdayReports > 0) {
            $this->reportGrowthPercentage = (($todayReports - $yesterdayReports) / $yesterdayReports) * 100;
        } else {
            $this->reportGrowthPercentage = $todayReports > 0 ? 100 : 0;
        }

        // Clamp the percentage between 0 and 100
        if ($this->reportGrowthPercentage > 100) {
            $this->reportGrowthPercentage = 100;
        } elseif ($this->reportGrowthPercentage < 0) {
            $this->reportGrowthPercentage = 0;
        }
    }

    public function updateAreas()
    {
        $areaCount = Area::whereDate('created_at', Carbon::now())->count();
        $yesterdayArea = Area::whereDate('created_at', Carbon::yesterday())->count();

        $this->areas = Area::count();;

        if ($yesterdayArea > 0) {
            $this->areaGrowthPercentage = (($areaCount - $yesterdayArea) / $yesterdayArea) * 100;
        } else {
            $this->areaGrowthPercentage = $areaCount > 0 ? 100 : 0;
        }

        // Clamp the percentage between 0 and 100
        if ($this->areaGrowthPercentage > 100) {
            $this->areaGrowthPercentage = 100;
        } elseif ($this->areaGrowthPercentage < 0) {
            $this->areaGrowthPercentage = 0;
        }
    }


    public function render()
    {
        return view('livewire.stats');
    }
}

