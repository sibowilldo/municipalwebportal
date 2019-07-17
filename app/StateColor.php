<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateColor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','css_class', 'css_color'
    ];
}
