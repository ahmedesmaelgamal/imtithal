<div class="col-lg-5 col-12">
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary d-flex align-items-center">نسبة إنجاز الموظفين</h5>

            <!-- اختيار السنة -->
            <select class="form-select" wire:model.live="selectedYear">
                @for ($i = now()->year; $i >= now()->year - 2; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <!-- اختيار الشهر -->
            <select class="form-select" wire:model.live="selectedMonth">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                @endfor
            </select>
        </div>

        <hr class="hr-card">

        <!-- عرض الموظفين -->
        @forelse($users as $employee)
            <div class="row card-section">
                <div class="col-2 image-card">
                    <img src="{{ getFile($employee->image, 'web/image/image1.png') }}" alt="no-image">
                </div>
                <div class="col-7 d-flex flex-column justify-content-center">
                    <h6>{{ $employee->full_name }}</h6>
                    <p class="fs-12 text-secondary">{{ $employee->getRoleNames()->first() }}</p>
                </div>
                <div class="col-3 mt-3">
                    <div class="{{ $employee->growthPercentage >= 0 ? 'status-true' : 'status-false' }}">
                        <img class="h-16"
                            src="{{ asset($employee->growthPercentage >= 0 ? 'web/image/arrow-up-right.png' : 'web/image/arrow-down-right.png') }}"
                            alt="no-icon">
                        <p>{{ number_format($employee->growthPercentage, 1) }}%</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-secondary">لا يوجد موظفون لهذا الشهر</p>
        @endforelse

    </div>
</div>
