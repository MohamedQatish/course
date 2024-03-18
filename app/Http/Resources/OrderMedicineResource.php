<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderMedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'scientific name' => $this->scientific_name,
            'commercial name' => $this->commercial_name,
            'category' => $this->category,
            'the manufacture company' => $this->the_manufacture_company,
            'quantity' => $this->quantity,
            'expire date' => $this->expire_date,
            'price' => $this->price,
        ];
    }
}
