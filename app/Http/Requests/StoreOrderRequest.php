<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // 'warehouse_id' => 'required|exists:warehouses,id',
            'medicines' => 'required|array', 

            
            'medicines.*.commercial_name' => 'required|string',
            'medicines.*.quantity' => 'required|integer|min:1',
        ];
    }
}
