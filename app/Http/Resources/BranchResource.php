<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'name' => $this->branch_name,
            'location' => $this->fullAddress(),
            'manager' => $this->manager ? $this->manager->fullName() : 'vacant',
            'total_customers' => count($this->customers),
            'total_complaints' => count($this->complaints),
        ];
    }
}
