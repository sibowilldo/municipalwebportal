<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
            'state_color' => strtolower($this->state_color->name),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
//            'categories' => CategoryResource::collection($this->categories)
        ];
    }
}
