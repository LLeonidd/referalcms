<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'number' => $this->number,
          'email' => $this->email,
          'address' => $this->address,
          'message' => $this->message,
          'rules' => $this->rules,
          'ref_id' => $this->ref_id,
        ];
    }
}
