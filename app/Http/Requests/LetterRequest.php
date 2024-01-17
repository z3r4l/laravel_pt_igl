<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LetterRequest extends FormRequest
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
            'category_letter_id'    => ['required'],
            'shipper_name'          => ['required'],
            'shipper_address'       => ['required'],
            'consignee_name'        => ['required'],
            'consignee_address'     => ['required'],
            'consignee_attn'        => ['required'],
            'consignee_phone'       => ['required'],
            'shipment'              => ['required'],
            'addmore.*.description'         => ['required'],
            'addmore.*.qty'                 => ['required'],
            'addmore.*.dimension'           => ['required'],
            'total_gross_weight'  => ['required'],
            'total_package'       => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'addmore.*.description.required'    => 'Description field is required.',
            'addmore.*.Dimension.required'      => 'Dimension field is required.',
            'addmore.*.qty.required'            => 'Qty field is required.',
        ];
    }
}
