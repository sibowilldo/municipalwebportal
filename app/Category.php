<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    //A Category belong to and has many Types through pivot (category_type)
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    //A Category has one State Color
    public function state_color()
    {
        return $this->belongsTo(StateColor::class);
    }
}
