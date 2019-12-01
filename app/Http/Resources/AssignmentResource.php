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
            'id'=> $this->id,
            'instructions' => $this->instructions,
            'dates' => [
                'declined_at' => $this->declined_at?$this->declined_at->format('Y-m-d h:s:j'):null,
                'completed_at' => $this->completed_at?$this->completed_at->format('Y-m-d h:s:j'):null,
                'executed_at' => $this->executed_at?$this->executed_at->format('Y-m-d h:s:j'):null,
                'due_at' => $this->due_at?$this->due_at->format('Y-m-d h:s:j'):null,
                'created_at' => $this->created_at->format('Y-m-d h:s:j')?:null,
                'updated_at' => $this->updated_at->format('Y-m-d h:s:j')?:null,
            ],
            'incident' => new IncidentResource($this->incident),
            'assigned_to' => $this->user,
            'assigned_by' => \App\User::findOrFail($this->assigner_id)
        ];
    }
}
