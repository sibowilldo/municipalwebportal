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
        'name','description', 'is_active', 'state_color'
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
    /**
     * The array of $state_colors.
     *
     * @var array
     */
    public static $statuses = [
        'available' => 'available',
        'inactive' => 'inactive',
        'active' => 'active',
        'blocked' => 'blocked',
        'assigned' => 'assigned',
        'trashed' => 'trashed'
    ];
}
