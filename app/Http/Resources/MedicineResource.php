<?php

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $warehouse=Warehouse::find($this->warehouse_id);
        return [
            // 'warehouse id'=>$this->warehouse_id,
            // 'warehouse name'=>$warehouse->name,
            'commercial name'=>$this->commercial_name,
            'scientific name'=>$this->scientific_name,
            'category'=>$this->category,
            'the manufacture company'=>$this->the_manufacture_company,
            'quantity'=>$this->quantity,
            'expire date'=>$this->expire_date,
            'price'=>$this->price
        ];
    }
}
