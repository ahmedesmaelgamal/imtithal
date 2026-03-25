<div class="card-border-shape mt-16">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div wire:poll.5s="updateDailyReport">
                <div class="card-home">
                    <h2 class="text-primary fw-700">{{ $dailyReport }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد التقارير اليومية</p>
                        <div class="{{ $dailyGrowthPercentage >= 0 ? 'status-true' : 'status-false' }}">
                            <img class="h-16"
                                 src="{{ asset($dailyGrowthPercentage >= 0 ? 'web/image/arrow-up-right.png' : 'web/image/arrow-down-right.png') }}"
                                 alt="no-icon">
                            <p>{{ number_format($dailyGrowthPercentage, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div wire:poll.5s="updateUsers"> <!-- تحديث كل 15 دقيقة -->
                <div class="card-home">
                    <h2 class="text-brown fw-700">{{ $users }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد الموظفين</p>
                        <div class="{{ $userGrowthPercentage >= 0 ? 'status-true' : 'status-false' }}">
                            <img class="h-16"
                                 src="{{ asset($userGrowthPercentage >= 0 ? 'web/image/arrow-up-right.png' : 'web/image/arrow-down-right.png') }}"
                                 alt="no-icon">
                            <p>{{ number_format($userGrowthPercentage, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div wire:poll.5s="updateReports">
                <div class="card-home">
                    <h2 class="text-primary2 fw-700">{{ $reports }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد البلاغات</p>
                        <div class="{{ $reportGrowthPercentage >= 0 ? 'status-true' : 'status-false' }}">
                            <img class="h-16"
                                 src="{{ asset($reportGrowthPercentage >= 0 ? 'web/image/arrow-up-right.png' : 'web/image/arrow-down-right.png') }}"
                                 alt="no-icon">
                            <p>{{ number_format($reportGrowthPercentage, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div wire:poll.5s="updateAreas">
                <div class="card-home">
                    <h2 class="text-green fw-700">{{ $areas }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد المواقع الجغرافية</p>
                        <div class="{{ $areaGrowthPercentage >= 0 ? 'status-true' : 'status-false' }}">
                            <img class="h-16"
                                 src="{{ asset($areaGrowthPercentage >= 0 ? 'web/image/arrow-up-right.png' : 'web/image/arrow-down-right.png') }}"
                                 alt="no-icon">
                            <p>{{ number_format($areaGrowthPercentage, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
