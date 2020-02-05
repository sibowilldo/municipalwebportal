<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'assigner_id','incident_id', 'instructions', 'is_active', 'is_group',
        'executed_at', 'declined_at', 'completed_at', 'due_at'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['executed_at', 'declined_at', 'completed_at', 'due_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected  $casts = ['is_active' => 'boolean', 'is_group' => 'boolean'];

    //An Assignment belongs to one user
    public function assigner()
    {
        return $this->belongsTo(User::class);
    }

    //An Assignment morphs to one user
    public function user()
    {
        return $this->morphTo(User::class);
    }

    //An Assignment morphs to one user
    public function working_group()
    {
        return $this->morphTo(WorkingGroup::class);
    }

    //An Assignment belongs to one incident
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    public function assignable()
    {
        return $this->morphTo();
    }
}
