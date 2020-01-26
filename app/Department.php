<?php

namespace App;

use App\Helpers\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use FormatDates;
    /**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    protected $fillable = [
        'name', 'district', 'description', 'contact_number', 'email','alt_contact_number', 'address', 'status_is'
    ];

    //Department has many users through pivot (department_user)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * The array of $statuses.
     *
     * @var array
     */
    public static $statuses = [
        'available' => 'available',
        'inactive' => 'inactive',
        'active' => 'active',
        'blocked' => 'blocked',
    ];
}
