<?php

namespace App;

use App\Events\SystemNotificationReadEvent;
use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{
    use FormatDates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'type', 'data', 'read_at'];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['read_at'];


    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'retrieved' => SystemNotificationReadEvent::class
    ];
}
