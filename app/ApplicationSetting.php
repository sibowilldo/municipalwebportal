<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'configuration_id','key', 'value', 'display', 'is_mobile', 'is_web', 'is_active'
    ];

    /**
     * The attribute that must casted
     * @var array
     */
    protected $casts = [
        'is_mobile' => 'boolean',
        'is_web' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function configuration()
    {
        return $this->belongsTo(Configuration::class);
    }
}
