<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class StatsTable extends Component
{
    public $selectedYear;
    public $selectedMonth;
    public $users = [];

    public function mount()
    {
        $this->selectedYear = now()->year;
        $this->selectedMonth = now()->month;
        $this->loadUsers();
    }

    // Livewire automatically detects when selectedYear or selectedMonth changes
    public function updatedSelectedYear()
    {
        $this->loadUsers();
    }

    public function updatedSelectedMonth()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        // جلب المستخدمين الذين لديهم مهام مكتملة في الشهر والسنة المحددين
        $this->users = User::whereHas('userDailyReports', function ($query) {
            $query->where('status', '4')
                ->whereMonth('created_at', $this->selectedMonth)
                ->whereYear('created_at', $this->selectedYear);
        })->get();

        // حساب عدد المهام لكل موظف اليوم وأمس
        $this->users->each(function ($user) {
            $today = now()->toDateString();
            $yesterday = now()->subDay()->toDateString();

            // عدد المهام اليوم
            $tasksToday = $user->userDailyReports()
                ->where('status', '4')
                ->whereDate('created_at', $today)
                ->count();

            // عدد المهام أمس
            $tasksYesterday = $user->userDailyReports()
                ->where('status', '4')
                ->whereDate('created_at', $yesterday)
                ->count();

            // حساب نسبة النمو مقارنة بأمس
            if ($tasksYesterday > 0) {
                $user->growthPercentage = (($tasksToday - $tasksYesterday) / $tasksYesterday) * 100;
            } else {
                $user->growthPercentage = $tasksToday > 0 ? 100 : 0; // إذا لم يكن هناك مهام أمس، فالتغيير يكون 100% إذا كان هناك مهام اليوم
            }
        });
    }



    public function render()
    {
        return view('livewire.stats-table');
    }
}
