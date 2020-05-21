<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use FormatDates, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['incidents'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description', 'is_active', 'state_color_id', 'model_type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function statusExists($name = null, $model_type = null)
    {
        return Status::where(['name'=> $name, 'model_type' => $model_type])->first();
    }
    //
    public function incidents()
    {
        return $this->hasMany(Incident::class);
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
     * @var string[]
     */

    public static $model_types = [
        'App\User' => 'Users',
        'App\Incident' => 'Incidents',
        'App\Department' => 'Departments',
        'App\District' => 'Districts',
        'App\Device' => 'Devices',
        'App\IncidentHistory' => 'Incident Histories',
        'App\WorkingGroup' => 'Working Groups',
    ];
}
