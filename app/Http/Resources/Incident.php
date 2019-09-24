<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Incident extends JsonResource
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
            'id' => $this->id,
            'reference' => $this->reference,
            'name' => $this->name,
            'description' => $this->description,
            'location_description' => $this->location_description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'suburb_id' => $this->suburb_id,
            'is_public' => $this->is_public,
            'created' => $this->created_at->format('d M Y h:i:s A'),
            'category' => new CategoryResource($this->type->categories->first()),
            'status' => new StatusResource($this->status),
            'users' => $this->users,
            'images' => $this->attachments,
            'assignments' => $this->assignments
        ];
    }
}
