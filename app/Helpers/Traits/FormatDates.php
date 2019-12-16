<?php
namespace App\Helpers\Traits;

use Carbon\Carbon;

trait FormatDates
{
    protected $format = 'Y-m-d H:i:s';

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format($this->format);
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format($this->format);
    }
}
