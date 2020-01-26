<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','pin_code', 'expires_at', 'is_active'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected  $dates = ['expires_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
