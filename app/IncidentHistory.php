<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'incident_id','previous_status', 'status_id', 'account_number', 'update_reason'
    ];

    //
    public function previous_status()
    {
        return $this->belongsTo(Status::class, 'previous_status');
    }

    //
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    //
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
