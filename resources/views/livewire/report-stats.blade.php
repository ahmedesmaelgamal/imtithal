<div class="col-lg-7 col-12">
    <div class="section-report-home">
        <div class="card-border mt-16">
            <div class="d-flex justify-content-between">
                <h5 class="text-primary d-flex align-items-center">التقارير الدورية</h5>
                <select class="form-select" aria-label="Default select example" wire:model.live="selectedDay">
                    <option selected value="now">اليوم</option>
                    <option value="prev">اليوم السابق</option>
                    <option value="next">اليوم التالى</option>
                    <option value="week">الاسبوع</option>
                </select>
            </div>
            <hr class="hr-card">
            @forelse ($reports as $report)
            <div class="card-section">
                <div class="p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary d-flex align-items-center">{{  @$report->dailyReport->title }}</h6>
                        <div class="status-new">
                            {{  App\Enum\DailyReportAssignUserStatusEnum::from($report->status)->lang() }}
                        </div>
                    </div>
                    <p class="fs-12 text-secondary fw-300 mt-2">
                        {{ @$report->dailyReport->description }}
                    </p>
                </div>
                <div class="bg-gray p-2">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <img class="h-36 rounded ms-2" src="{{ getFile(@$report->user->image,'web/image/image1.png') }}"
                                alt="no-image">
                            <h6 class="text-secondary2 fs-12 d-flex align-items-center">
                                {{ @$report->user->full_name }}
                            </h6>
                        </div>
                        <div class="col-6 d-flex">
                            <img class="h-36 rounded ms-2" src="{{ asset('web/image/date-icon.png') }}"
                                alt="no-image">
                            <h6 class="text-secondary2 fs-12 d-flex align-items-center">{{ $report->formatted_date }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-secondary">لا يوجد تقارير لهذا اليوم</p>
            @endforelse
        </div>
    </div>
</div>
