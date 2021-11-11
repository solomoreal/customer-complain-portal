<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'full_name' => $this->fullName(),
            'full_address' => $this->fullAddress(),
            'phone' => $this->phone,
            'email' => $this->email,
            'number_of_complains' => count($this->complains),
            'photo' => $this->getFirstMedia('photo') ? $this->getFirstMedia('photo')->getFullUrl('thumb') : $this->photo,
        ];
    }
}
