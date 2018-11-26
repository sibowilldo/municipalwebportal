<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $guard_name = 'api';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'contactnumber', 'email', 'email_verified_at', 'activation_token','password', 'status_is', 'last_loggedin_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'last_loggedin_at', 'email_verified_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];


    //
    public function incidents()
    {
        return $this->belongsToMany(Incident::class);
    }

    //
    public function devices()
    {
        return $this->belongsToMany(Device::class);
    }

    //
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    //
    public function otp()
    {
        return $this->hasMany(OTP::class);
    }
}
