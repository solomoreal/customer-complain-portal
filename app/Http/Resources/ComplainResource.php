<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplainResource extends JsonResource
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
            'title' => $this->title,
            'message' => $this->message,
            'sent_by' => $this->customer->fullName(),
            'branch' => $this->branch->branch_name,
            'status' => $this->reviewed ? 'reviewed' : 'pending',
        ];
    }
}
