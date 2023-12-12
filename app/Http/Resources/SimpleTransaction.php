<?php

namespace App\Http\Resources;

use App\Http\Resources\SimpleUser;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleTransaction extends JsonResource
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
            'username' => $this->resource->user->name,
            'due_on' => $this->resource->due_on,
            'vat' => $this->resource->vat,
            'is_vat_inclusive' => $this->resource->is_vat_inclusive,
            'status' => $this->resource->status,
            'payments_count' => $this->resource->payments_count,
            'remaining' => $this->resource->remaining,
            'created_at' => $this->resource->created_at,
        ];
    }
}
