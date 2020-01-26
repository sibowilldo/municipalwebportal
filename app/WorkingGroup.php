<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class WorkingGroup extends Model
{
    use FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description', 'is_active', 'state_color_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    //An Incident belongs to many users through pivot (user_working_group)
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps()
                    ->withPivot('is_leader', 'instructions', 'assigner_id');
    }

    /**
     *
     *
     */
    public function assignments()
    {
        return $this->morphMany(Assignment::class, 'assignable');
    }
}
