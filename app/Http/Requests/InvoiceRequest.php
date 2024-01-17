<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                          => ['required'],
            'address'                       => ['required'],
            'attn'                          => ['required'],
            'vessel'                        => ['required'],
            'voy'                           => ['required'],
            'addmore.*.description'         => ['required'],
            'addmore.*.unit'                => ['required'],
            'addmore.*.qty'                 => ['required'],
            'addmore.*.rate'                => ['required'],
         
        ];
    }

    public function messages(): array
    {
        return [
            'addmore.*.description.required' => 'Description field is required.',
            'addmore.*.unit.required' => 'Unit field is required.',
            'addmore.*.qty.required' => 'Qty field is required.',
            'addmore.*.rate.required' => 'Rate field is required.',
           
            
        ];
    }
}
