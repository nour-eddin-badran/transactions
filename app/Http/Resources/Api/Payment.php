<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SimpleUser;
use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'id' => $this->resource->id,
            'amount' => $this->resource->amount,
            'paid_on' => $this->resource->paid_on,
            'created_at' => $this->resource->created_at->diffForHumans(),
        ];
    }
}
