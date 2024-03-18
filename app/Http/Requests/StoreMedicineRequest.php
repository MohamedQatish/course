<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreMedicineRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'scientific_name'=>['required'],
            'commercial_name'=>['required'],
            'medicine_category_id'=>['required',Rule::in([1,2,3,4,5,6,7,8,9,10])],
            'the_manufacture_company'=>['required'],
            'quantity'=>['required','integer','min:1'],
            'expire_date'=>['required','date'],
            'price'=>['required','numeric','min:0']
        ];
    }
}
