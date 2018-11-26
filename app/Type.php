<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description', 'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    //A Type belongs to an Incident
    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }

    //A Type belongs to and has many Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
