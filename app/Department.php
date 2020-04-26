<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use FormatDates, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'district_id', 'description', 'contact_number', 'email','category_id', 'address', 'status_id'
    ];

    //Department has many users through pivot (department_user)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
