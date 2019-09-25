<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description', 'is_active', 'state_color_id', 'group'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    //
    public function incident()
    {
        return $this->hasOne(Incident::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function state_color()
    {
        return $this->belongsTo(StateColor::class);
    }

    //A Status has many Incident Histories
    public function histories()
    {
        return $this->hasMany(IncidentHistory::class);
    }
    /**
     * The array of $state_colors.
     *
     * @var array
     */
    public static $groups = [
        'users' => 'Users',
        'incidents' => 'Incidents',
        'both' => 'Both'
    ];
}
