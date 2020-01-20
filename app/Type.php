<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
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

    //A Type belongs to Many Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //A Type has One State Color
    public function state_color()
    {
        return $this->belongsTo(StateColor::class);
    }

}
