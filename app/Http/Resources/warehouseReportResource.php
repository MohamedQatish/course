<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class warehouseReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'order id'=>$this->id,
                'pharmacist' => $this->whenLoaded('pharmacist', $this->pharmacist->name),
                'warehouse' => $this->whenLoaded('warehouse', $this->warehouse->name),
                'status' => $this->status,
                'payment_status' => $this->payment_status,
                'invoice' => $this->invoice,
            
        ];
    }
}
