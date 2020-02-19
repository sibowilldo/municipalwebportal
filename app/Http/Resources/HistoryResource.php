<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            "history_id"=> $this->id,
            "incident_id"=> $this->incident_id,
            "statuses" => [
                "previous"=> StatusResource::collection($this->previous_status()->get()),
                "current"=> new StatusResource($this->status),
            ],
            "account_number"=> $this->account_number,
            "update_reason"=> $this->update_reason,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at
        ];
    }
}
