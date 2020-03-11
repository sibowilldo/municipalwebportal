<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidentSpaResource extends JsonResource
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
            'type' => new TypeResource($this->type),
            'status' => new StatusResource($this->status),
            'users' => $this->users,
            'images' => $this->attachments,
            'assignments' => $this->assignments,
            'links' => [
                '_self' => route('incidents.show', $this->id),
                '_index' => route('incidents.index')
            ]
        ];
    }
}
