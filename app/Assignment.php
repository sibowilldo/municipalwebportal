<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','incident_id', 'instructions', 'executed_at', 'due_at'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['executed_at', 'due_at'];


    //An Assignment belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //An Assignment belongs to one incident
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
