<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'state_color_id' => $this->state_color->name,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d M Y h:i:s A'),
            'types' => $this->types
        ];
    }
}
