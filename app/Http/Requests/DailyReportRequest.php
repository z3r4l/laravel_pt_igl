<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DailyReportRequest extends FormRequest
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
            'type_document'     => ['required'],
            'no_pendaftaran'    => ['required'],
            'date_document'     => ['required'],
            'shipper'           => ['required'],
            'consignee'         => ['required'],
            'name_vessel'       => ['required'],
            'voy'               => ['required'],
            'no_tax'            => ['nullable'],
            'date_faktur'       => ['nullable'],
            'no_bl'             => ['required'],
            'status'            => ['required'],
        ];
    }
}
