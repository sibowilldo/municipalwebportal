<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
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
            'device_id' => $this->device_id,
            'os' => $this->os,
            'token' => $this->token,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->format('d M Y h:i:s A'),
            'updated_at' => $this->updated_at->format('d M Y h:i:s A')
        ];
    }
}
