<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Incident as IncidentResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'contactnumber' => $this->contactnumber,
            'roles' => $this->getRoleNames(),
            'incidents' => IncidentResource::collection($this->incidents),
            'departments' => $this->departments,
            'devices' => DeviceResource::collection($this->devices)
        ];
    }
}
