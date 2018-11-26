<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_id','path', 'filename', 'is_active'
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
    public function meta()
    {
        return $this->hasOne(Meta::class);
    }

    //
    public function incidents()
    {
        return $this->belongsToMany(Incident::class);
    }
}
