<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use FormatDates;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'metadata'
    ];

    //
    public function attachment()
    {
        return $this->belongsTo(Attachment::class);
    }
}
