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
            'name' => app('profanityFilter')->filter($this->name),
            'description' => app('profanityFilter')->filter($this->description),
            'location_description' => $this->location_description,
            'coordinates' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'suburb_id' => $this->suburb_id,
            'is_public' => $this->is_public,
            'created' => $this->created_at,
            'category' => new CategoryResource($this->type->categories->first()),
            'status' => new StatusResource($this->status),
            'users' => $this->users,
            'images' => $this->attachments,
            'assignments' => $this->assignments
        ];
    }
}
