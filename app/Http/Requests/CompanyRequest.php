<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
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
            'name_company'                  => ['required'],
            'website'                       => ['required'],
            'address'                       => ['required'],
            'description'                   => ['required'],
            'addmore.*.name_customer'       => ['required'],
            'addmore.*.email'               => ['required'],
            'addmore.*.phone'               => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'addmore.*.name_customer.required'      => ' Customer name field is required.',
            'addmore.*.email.required'              => 'Email field is required.',
            'addmore.*.phone.required'              => 'Phone field is required.',
        ];
    }
}
