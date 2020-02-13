<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingGroupResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'team' => [
                'leader' => $this->users()->where('is_leader', true)->first(),
                'engineers' => $this->users()->where('is_leader', false)->get()
            ]
        ];
    }
}
