<?php

namespace App\Services\Web;

use App\Models\Setting as ObjModel;

use App\Services\BaseService;
use App\Services\FirestoreService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class SettingsService extends BaseService
{

    public function __construct(
        protected ObjModel $objModel,
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        $shifts = $this->model->all()->map(function ($shift) {
            $shift->checkin_date = Carbon::createFromFormat('H:i:s', $shift->checkin_date)->addHours(3)->format('H:i:s');
            $shift->checkin_max_date = Carbon::createFromFormat('H:i:s', $shift->checkin_max_date)->addHours(3)->format('H:i:s');
            $shift->checkout_date = Carbon::createFromFormat('H:i:s', $shift->checkout_date)->addHours(3)->format('H:i:s');
            $shift->checkout_max_date = Carbon::createFromFormat('H:i:s', $shift->checkout_max_date)->addHours(3)->format('H:i:s');
            return $shift;
        });

        return view('web.settings.index', [
            'shifts' => $shifts,
        ]);
    }

    public function update($request)
    {
        $request->validate([
            'shifts' => 'required|array',
            'shifts.*.name' => 'required|string',
            'shifts.*.checkin_date' => 'required',
            'shifts.*.checkin_max_date' => 'required',
            'shifts.*.checkout_date' => 'required',
            'shifts.*.checkout_max_date' => 'required',
        ]);
    
        try {
            // Get all existing shift codes from database
            $existingCodes = $this->model->pluck('code')->toArray();
            
            // Process submitted shifts
            $submittedCodes = [];
            
            foreach ($request->shifts as $shiftData) {
                if (isset($shiftData['_delete'])) {
                    continue;
                }
            
                $submittedCodes[] = $shiftData['code'];
            
                // Check if this is a new shift (i.e., not in DB)
                $existingShift = $this->model->where('code', $shiftData['code'])->first();
            
                // Prepare time data
                $timeData = [
                    'name' => $shiftData['name'],
                    'checkin_date' => $shiftData['checkin_date'],
                    'checkin_max_date' => $shiftData['checkin_max_date'],
                    'checkout_date' => $shiftData['checkout_date'],
                    'checkout_max_date' => $shiftData['checkout_max_date'],
                ];
            
                // Add 3 hours to time fields if creating new shift
                // if (!$existingShift) {
                    $timeData['checkin_date'] = Carbon::createFromFormat('H:i', $shiftData['checkin_date'])->subHours(3)->format('H:i:s');
                    $timeData['checkin_max_date'] = Carbon::createFromFormat('H:i', $shiftData['checkin_max_date'])->subHours(3)->format('H:i:s');
                    $timeData['checkout_date'] = Carbon::createFromFormat('H:i', $shiftData['checkout_date'])->subHours(3)->format('H:i:s');
                    $timeData['checkout_max_date'] = Carbon::createFromFormat('H:i', $shiftData['checkout_max_date'])->subHours(3)->format('H:i:s');
                // }
            
                // Create or update
                $this->model->updateOrCreate(
                    ['code' => $shiftData['code']],
                    $timeData
                );
            }
            
            
            // Delete shifts that weren't submitted
            $codesToDelete = array_diff($existingCodes, $submittedCodes);
            if (!empty($codesToDelete)) {
                $this->model->whereIn('code', $codesToDelete)->delete();
            }
    
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث البيانات بنجاح'
            ], 200);
    
        } catch (\Exception $e) {
            // Handle any exceptions, including date parsing errors
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء معالجة البيانات: ' . $e->getMessage()
            ], 500);
        }
    }
}