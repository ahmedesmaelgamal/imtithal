<?php
namespace App\Imports;

use App\Mail\RegisterMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DynamicModelImport implements ToCollection
{
    protected $modelClass;
    protected $uniqueIdentifier;

    public function __construct($modelClass, $uniqueIdentifier)
    {
        $this->modelClass = $modelClass;
        $this->uniqueIdentifier = $uniqueIdentifier;
    }

    public function collection(Collection $rows)
    {
        $rawHeaderLine = $rows->first();
        if (!$rawHeaderLine) return;
        
        $modelInstance = new $this->modelClass;
        $fillable = $modelInstance->getFillable();
        
        $mapping = [
            'رقم الرحلة' => 'trip_number',
            'الناقل الجوي' => 'air_carrier',
            'دولة الاقلاع' => 'departure_country',
            'دولة الحجاج' => 'departure_country',
            'رقم كشف الاستعداد' => 'readiness_list_number',
            'شركة تقديم الخدمة' => 'service_provider',
            'عدد مجموعات الحجاج بالرحلة' => 'hajj_groups_count',
            'عدد الحجاج' => 'hajjis_count',
            'تاريخ الوصول' => 'arrival_date',
            'وقت الوصول' => 'arrival_time',
            'المنفذ' => 'executor', 
            'العقد' => 'executor',
            'جهة التنفيذ' => 'executor',
            'رقم العقد' => 'contract_number',
            'المنطقة' => 'area_name',
            'السكن' => 'area_name',
            'اسم السكن' => 'area_name',
            'اسم المنطقة' => 'area_name',
            'مدينة السكن' => 'residence_city',
            'الاسم الكامل' => 'full_name',
            'البريد الالكتروني' => 'email',
            'رقم الهوية' => 'national_id',
            'رقم الجوال' => 'phone',
            'اسم الصلاحية' => 'role_name',
        ];

        $header = [];
        $validHeaderCount = 0;
        foreach ($rawHeaderLine as $index => $h) {
            $h = trim($h);
            if ($h) {
                $mapped = $mapping[$h] ?? $h;
                $header[$index] = $mapped;
                $validHeaderCount++;
            }
        }

        if ($this->modelClass === \App\Models\Trip::class) {
            $fillable[] = 'area_name';
            $fillable[] = 'residence_city';
            $requiredKeys = ['trip_number', 'arrival_date'];
        } else {
            $requiredKeys = [];
        }

        $matchedCount = 0;
        foreach ($header as $col) {
            if (in_array($col, $fillable)) {
                $matchedCount++;
            }
        }

        $missingRequired = array_diff($requiredKeys, $header);
        
        if (count($missingRequired) > 0 || ($validHeaderCount > 0 && $matchedCount < ($validHeaderCount * 0.4))) {
             throw new \Exception('ملف الإكسيل غير مطابق للنموذج المطلوب. يرجى التأكد من أن أسماء الأعمدة مطابقة للبيانات المطلوبة.');
        }

        $rows = $rows->skip(1);

        foreach ($rows as $row) {
            $data = [];
            $hasData = false;
            foreach ($header as $index => $column) {
                $val = trim($row[$index] ?? '');
                if ($val !== '') $hasData = true;
                $data[$column] = $val;
            }

            if (!$hasData) continue;

            // Format dates if present
            foreach (['arrival_date', 'arrival_time'] as $dateKey) {
                if (!empty($data[$dateKey])) {
                    try {
                        if (is_numeric($data[$dateKey])) {
                            $format = ($dateKey === 'arrival_time') ? 'H:i:s' : 'Y-m-d';
                            $data[$dateKey] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data[$dateKey])->format($format);
                        } else {
                            $format = ($dateKey === 'arrival_time') ? 'H:i' : 'Y-m-d';
                            $data[$dateKey] = \Carbon\Carbon::parse($data[$dateKey])->format($format);
                        }
                    } catch (\Exception $dateError) {
                        \Log::warning("Could not parse date/time {$data[$dateKey]}: " . $dateError->getMessage());
                    }
                }
            }

            $record = $this->findExistingRecord($data);

            if ($this->modelClass === \App\Models\Trip::class) {
                if (!empty($data['area_name'])) {
                    $normName = $this->normalizeName($data['area_name']);
                    $resCity = !empty($data['residence_city']) ? $this->normalizeName($data['residence_city']) : '';
                    
                    // Detect parent hub (Maka or Madina)
                    $parentId = null;
                    if (str_contains($normName, 'مكه') || str_contains($resCity, 'مكه')) {
                        $parentId = \App\Models\Area::where('name', 'like', '%مساكن مكه%')->whereNull('parent_id')->value('id');
                    } elseif (str_contains($normName, 'مدينه') || str_contains($resCity, 'مدينه')) {
                        $parentId = \App\Models\Area::where('name', 'like', '%مساكن المدينه%')->whereNull('parent_id')->value('id');
                    }

                    // Use firstOrCreate with ONLY the name to prevent duplicates
                    $area = \App\Models\Area::where('name', $data['area_name'])->first();
                    if (!$area) {
                        $area = \App\Models\Area::create([
                            'name' => $data['area_name'],
                            'parent_id' => $parentId,
                            'type' => 'sub',
                            'location' => $data['residence_city'] ?? null,
                            'status' => 1
                        ]);
                    }
                    
                    $data['area_id'] = $area->id;
                }
            }

            if ($this->modelClass === \App\Models\User::class) {
                $randomPassword = rand(10000000, 99999999);
                if (!$record) {
                    $data['password'] = Hash::make($randomPassword);
                }
                $data['status'] = 1;
            }

            if ($record) {
                $record->update($data);
            } else {
                $record = $this->modelClass::create($data);
            }

            if ($this->modelClass === \App\Models\User::class) {
                if (isset($randomPassword)) {
                    $record['randomPassword'] = $randomPassword;
                    if (isset($record->email)) {
                        Mail::to($record->email)->queue(new RegisterMail($record));
                    }
                }
                
                if (!empty($data['role_name'])) {
                    $role = Role::where('name', $data['role_name'])->first();
                    if ($role) {
                        $record->syncRoles([$role->name]);
                    }
                }
            }
        }
    }

    protected function findExistingRecord($data)
    {
        if ($this->modelClass === \App\Models\Trip::class) {
            // Matching logic: if 2 or more of these 4 keys match, it's an update
            $keys = ['trip_number', 'arrival_date', 'arrival_time', 'readiness_list_number'];
            $bestMatch = null;
            $maxMatches = 0;

            // We need to check existing trips. To optimize, we filter by any of the keys first
            $possibleTrips = \App\Models\Trip::where(function($q) use ($data, $keys) {
                foreach($keys as $key) {
                    if (!empty($data[$key])) $q->orWhere($key, $data[$key]);
                }
            })->get();

            foreach ($possibleTrips as $trip) {
                $matches = 0;
                foreach ($keys as $key) {
                    if (!empty($data[$key]) && $trip->$key == $data[$key]) {
                        $matches++;
                    }
                }
                if ($matches >= 2 && $matches > $maxMatches) {
                    $maxMatches = $matches;
                    $bestMatch = $trip;
                }
            }
            return $bestMatch;
        }

        if ($this->modelClass === \App\Models\User::class) {
            return $this->modelClass::where('email', $data['email'] ?? '---')
                ->orWhere('phone', $data['phone'] ?? '---')
                ->orWhere('national_id', $data['national_id'] ?? '---')->first();
        }

        if ($this->uniqueIdentifier && isset($data[$this->uniqueIdentifier])) {
            return $this->modelClass::where($this->uniqueIdentifier, $data[$this->uniqueIdentifier])->first();
        }

        return null;
    }
    protected function normalizeName($name)
    {
        if (!$name) return '';
        $name = trim($name);
        // Replace non-breaking spaces and multi-spaces with simple space
        $name = preg_replace('/[\s\x{00A0}]+/u', ' ', $name);
        // Arabic character normalization
        $name = str_replace(['ة', 'أ', 'إ', 'آ'], ['ه', 'ا', 'ا', 'ا'], $name);
        return $name;
    }
}
