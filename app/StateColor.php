<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class StateColor extends Model
{
    use FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','css_class', 'css_color', 'css_font_color'
    ];


    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
