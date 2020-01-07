<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'guard_name' => $this->guard_name,
                'permissions' => $this->permissions,
                'created_at' => $this->created_at->format('d M Y'),
                'last_updated' => $this->updated_at->diffForHumans()
            ],
            'links' => [
                '_self'=>route('roles.show', $this->id),
                '_index'=>route('roles.index'),
            ]
        ];
    }
}
