<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
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
