<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application','version', 'api_key', 'expires_at'
    ];

    /**
     * The attributes that must be mutated as dates
     *
     * @var array
     */
    protected $dates = ['expires_at'];

    //
    public function settings()
    {
        return $this->hasMany(ApplicationSetting::class);
    }
}
