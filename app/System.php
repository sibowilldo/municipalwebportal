<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
use FormatDates;
    /**
     * The array of $state_colors.
     *
     * @var array
     */
    public static $state_colors = [
        'success' => 'success',
        'warning' => 'warning',
        'danger' => 'danger',
        'info' => 'info',
        'primary' => 'primary',
        'secondary' => 'secondary',
        'brand' => 'brand',
        'accent' => 'accent',
        'focus' => 'focus',
        'metal' => 'metal',
        'light' => 'light'
    ];
}
