<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'notice_type_id',
        'suggestion_title',
        'lat',
        'description',
        'long',
        'user_type',
        'notice_time',
        'notice_date',
        'user_id',
        'status',
        'refuse_reason',
        'refuse_notice',
        'admin_id',
        'leader_id',
        'is_up'
    ];


    public function noticeType()
    {
        return $this->belongsTo(NoticeType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function media()
    {
        return $this->morphMany('App\Models\Media', 'model');
    }

    public function getLocationName()
    {
        $lat = $this->lat;
        $long = $this->long;
        $url = 'https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' . $lat . '&lon=' . $long;

        $context = stream_context_create([
            'http' => [
                'header' => "User-Agent: MyAppName/1.0 (myemail@example.com)\r\n"
            ]
        ]);

        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        $road = $data['address']['road'] ?? null;
        $city = $data['address']['city']
            ?? $data['address']['town']
            ?? $data['address']['village']
            ?? null;
        $country = $data['address']['country'] ?? null;

        return implode(', ', array_filter([$road, $city, $country]));
    }

    public function getFormattedDate()
    {
        $formattedDate = Carbon::parse($this->created_at)->locale('ar')->translatedFormat('d F Y – الساعة h:i A');
        return str_replace(['AM', 'PM'], ['صباحًا', 'مساءً'], $formattedDate);
    }



}
