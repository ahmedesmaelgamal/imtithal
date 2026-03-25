<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getFile')) {
    function getFile($image, $empty = 'assets/uploads/empty.png'): string
    {
        if ($image != null) {
            // Remove the 'storage/' prefix from the path
            $relativePath = str_replace('storage/', '', $image);

            // Check if the file exists in the 'public' disk
            if (Storage::disk('public')->exists($relativePath)) {
                // Generate the correct URL for the file
                return asset('storage/' . $relativePath);
            } else {
                // Return the default image if the file does not exist
                return asset($empty);
            }
        } else {
            // Return the default image if no image is provided
            return asset($empty);
        }
    }
}

if (!function_exists('getFileWithName')) {
    function getFileWithName($name): string
    {

        return 'https://ui-avatars.com/api/?background=009FE3&bold=true&color=ffff&name=' . urlencode($name) . '';
    }
}

if (!function_exists('translateMonthToArabic')) {
    function translateMonthToArabic($englishMonth)
    {
        $months = [
            'January' => 'يناير',
            'February' => 'فبراير',
            'March' => 'مارس',
            'April' => 'أبريل',
            'May' => 'مايو',
            'June' => 'يونيو',
            'July' => 'يوليو',
            'August' => 'أغسطس',
            'September' => 'سبتمبر',
            'October' => 'أكتوبر',
            'November' => 'نوفمبر',
            'December' => 'ديسمبر',
        ];

        return $months[$englishMonth] ?? $englishMonth;
    }
}


if (!function_exists('checkRate')) {
    function checkRate($table1, $table2 = null, $column = null, $value = null, $type = null): string
    {
        if ($type=='suggest'){

            $model = \App\Models\Notice::whereHas('noticeType', function ($query) {
                $query->where('priority', 'suggest');
            });
            if ($table2 && $column == null && $value == null) {

                $today1 = $model->whereDate('created_at', now())->count();
                $yesterday1 = $model->whereDate('created_at', now()->subDay())->count();
                $today2 = $model->whereDate('created_at', now())->count();
                $yesterday2 = $model->whereDate('created_at', now()->subDay())->count();
                $rate1 = $yesterday1 !== 0 ? ($today1 - $yesterday1) / $yesterday1 * 100 : 0;
                $rate2 = $yesterday2 !== 0 ? ($today2 - $yesterday2) / $yesterday2 * 100 : 0;

                $rate = ($rate1 + $rate2) / 2;
                return $rate;

            } elseif ($table2 && $column && $value) {
                $today1 = $model->whereDate('created_at', now())->where($column, (string)$value)->count();
                $yesterday1 = $model->whereDate('created_at', now()->subDay())->where($column, (string)$value)->count();
                $today2 = $model->whereDate('created_at', now())->where($column,(string) $value)->count();
                $yesterday2 = $model->whereDate('created_at', now()->subDay())->where($column, (string)$value)->count();
                $rate1 = $yesterday1 !== 0 ? ($today1 - $yesterday1) / $yesterday1 * 100 : 0;
                $rate2 = $yesterday2 !== 0 ? ($today2 - $yesterday2) / $yesterday2 * 100 : 0;
                $rate = ($rate1 + $rate2) / 2;
                return $rate;

            }
            $today = $model->whereDate('created_at', now())->count();
            $yesterday = $model->whereDate('created_at', now()->subDay())->count();
            $rate = $yesterday !== 0 ? ($today - $yesterday) / $yesterday * 100 : 0;
            return $rate;

        }else{


        if ($table2 && $column == null && $value == null) {

            $today1 = DB::table($table1)->whereDate('created_at', now())->count();
            $yesterday1 = DB::table($table1)->whereDate('created_at', now()->subDay())->count();
            $today2 = DB::table($table2)->whereDate('created_at', now())->count();
            $yesterday2 = DB::table($table2)->whereDate('created_at', now()->subDay())->count();
            $rate1 = $yesterday1 !== 0 ? ($today1 - $yesterday1) / $yesterday1 * 100 : 0;
            $rate2 = $yesterday2 !== 0 ? ($today2 - $yesterday2) / $yesterday2 * 100 : 0;

            $rate = ($rate1 + $rate2) / 2;
            return $rate;

        } elseif ($table2 && $column && $value) {
            $today1 = DB::table($table1)->whereDate('created_at', now())->where($column,(string) $value)->count();
            $yesterday1 = DB::table($table1)->whereDate('created_at', now()->subDay())->where($column,(string) $value)->count();
            $today2 = DB::table($table2)->whereDate('created_at', now())->where($column, (string)$value)->count();
            $yesterday2 = DB::table($table2)->whereDate('created_at', now()->subDay())->where($column,(string) $value)->count();
            $rate1 = $yesterday1 !== 0 ? ($today1 - $yesterday1) / $yesterday1 * 100 : 0;
            $rate2 = $yesterday2 !== 0 ? ($today2 - $yesterday2) / $yesterday2 * 100 : 0;
            $rate = ($rate1 + $rate2) / 2;
            return $rate;

        }
        $today = DB::table($table1)->whereDate('created_at', now())->count();
        $yesterday = DB::table($table1)->whereDate('created_at', now()->subDay())->count();
        $rate = $yesterday !== 0 ? ($today - $yesterday) / $yesterday * 100 : 0;
        return $rate;

    }
    }
}

function getFileSizeInMB($filePath)
{
    if (!$filePath) {
        return null;
    }


    if (!file_exists($filePath)) {
        return null;
    }
    $sizeInBytes = filesize($filePath);

    return round($sizeInBytes / 1048576, 2) . ' MB';

}


if (!function_exists('lang')) {

    function lang()
    {

        return Config::get('app.locale');
    }
}

if (!function_exists('activeRoute')) {
    function activeRoute($route_name, $class = 'active')
    {
        return Route::currentRouteName() == $route_name ? $class : '';
    }
}


if (!function_exists('flang')) {

    function flang($en, $ar)
    {
        if (lang() == 'ar')
            return $ar;
        else
            return $en;
    }
}

if (!function_exists('trns')) {
    function trns($key)
    {
        $path = resource_path("lang/en/file.php");

        // Ensure the language file exists
        if (!File::exists($path)) {
            File::put($path, "<?php\n\nreturn [];\n");
        }
        $translations = include $path;
        // Convert key to human-readable format
        $value = ucwords(str_replace('_', ' ', $key));

        if (!array_key_exists($key, $translations)) {
            $translations[$key] = $value;

            // Save the translations back to the file
            $exported = var_export($translations, true);
            File::put($path, "<?php\n\nreturn {$exported};\n");
            return trans('file.' . $key);
        } else {
            return trans('file.' . $key);
        }
    }
}

if (!function_exists('latAndLong')) {
    function latAndLong($location)
    {
        if (strpos($location, ',') !== false) {
            $coordinates = explode(',', $location);
            $latitude = $coordinates[0];
            $longitude = $coordinates[1];
        } else {
            $latitude = null;
            $longitude = null;
        }

        return (object)[
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }
}
