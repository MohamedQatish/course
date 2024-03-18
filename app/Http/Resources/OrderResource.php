<?php

namespace App\Http\Resources;

use App\Models\Pharmacist;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderMedicineResource;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $pharmacist=Pharmacist::where('id',$this->pharmacist_id)->first();
        // $warehouse=Warehouse::where('id',$this->warehouse_id)->first();
        // return [
        //     'pharmacist'=>$pharmacist->name,
        //     'warehouse'=>$warehouse->name,
        //     'medicines'=>new MedicineCollection($this->medicines),
        //     'status'=>$this->status,
        //     'payment status'=>$this->payment_status,
        //     'invoice'=>$this->invoice
        // ];
        return [
            'order id'=>$this->id,
            'pharmacist' => $this->whenLoaded('pharmacist', $this->pharmacist->name),
            'warehouse' => $this->whenLoaded('warehouse', $this->warehouse->name),
            'medicines' => new OrderMedicineCollection($this->whenLoaded('medicines')),
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'invoice' => $this->invoice,
        ];

    }
}
