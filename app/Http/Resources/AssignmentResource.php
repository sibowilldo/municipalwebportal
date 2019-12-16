<?php

namespace App\Http\Resources;

use App\Http\Resources\Incident as IncidentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
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
            'incident' => new IncidentResource($this->incident),
            'assigned_to' => $this->user,
            'assigned_by' => \App\User::findOrFail($this->assigner_id)
        ];
    }
}
