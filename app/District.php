<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact_number', 'email', 'website'
    ];

    protected $spatialFields = [
        'location',
        'area'
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

}
