<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'costomer_id' => $this->costomer_id,
            'date' => $this->date->format('Y-m-d'),
            'ammount' => $this->ammount,
            'discount' => $this->discount,
            'status' => $this->status->__toString(),
        ];
    }
}
