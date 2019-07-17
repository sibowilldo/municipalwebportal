<?php

namespace App;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use SoftDeletes, GeneratesUuid;

    protected $casts = ['uuid' => 'uuid'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'reference','name', 'description', 'location_description', 'latitude', 'longitude','suburb_id','is_public' , 'type_id', 'status_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


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
        return $this->belongsTo(Status::class);
    }

    //An Incident has one Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
