<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'parent_id',
        'season_id',
        'location',
        'latitude',
        'longitude',
        'status'
    ];

    public function team()
    {
        return $this->hasMany(AreaTeam::class, 'area_id');
    }

    public function leaderTeam()
    {
        return $this->hasMany(AreaTeam::class)->where('type', 1);
    }

    public function leaderTeamName()
    {
        $leaderTeam = $this->hasMany(AreaTeam::class)->where('type', 1)->first();
        return $leaderTeam ? $leaderTeam->user()->first()->full_name : null;
    }

    public function memberTeam()
    {
        return $this->hasMany(AreaTeam::class)->where('type', 0);
    }

    public function location()
    {
        return $this->hasOne(AreaLocation::class, 'area_id');

    }

    /**
     * Get the parent area.
     */
    public function parent()
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }

    /**
     * Get the sub-areas.
     */
    public function children()
    {
        return $this->hasMany(Area::class, 'parent_id');
    }

    /**
     * Get the season for the area.
     */
    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    /**
     * Scope for main areas only.
     */
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Get the sub-areas only.
     */
    public function scopeSub($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function dailyReportAssignUser()
    {
        return $this->hasMany(DailyReportAssignUser::class,'area_id','id');
    }

    public function areaPoints()
    {
        return $this->hasMany(AreaPoint::class, 'area_id');
    }

    public function busReport()
    {
        return $this->HasOne(BusReport::class,'area_id','id')->latest();
    }

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'area_survey', 'area_id', 'survey_id');
    }

}
