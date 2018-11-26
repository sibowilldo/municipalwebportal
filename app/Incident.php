<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference','name', 'description', 'location_description', 'latitude', 'longitude','suburb_id', 'type_id', 'status_id'
    ];


    //An Incident belongs to many users through pivot (incident_user)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //An Incident can have Many Assignments
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    //An Incident belongs to and has many attachments through pivot (attachment_incident)
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }

    //An Incident has one Status
    public function status()
    {
        return $this->hasOne(Status::class);
    }

    //An Incident has one Type
    public function type()
    {
        return $this->hasOne(Type::class);
    }
}
