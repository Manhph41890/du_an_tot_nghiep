<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankRequest extends FormRequest
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
            'bank_id' => 'required|string|max:255',
            'img' => 'nullable|url|max:255',
            'account_number' => 'required|numeric|digits_between:6,12',
            'account_holder' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Z0-9\s]+$/', // Chỉ cho phép chữ cái in hoa, số, và khoảng trắng
            ],
            'pin' => 'required|numeric|digits:4',
        ];
    }
    public function messages()
    {
        return [
            'bank_id.required' => 'Vui lòng chọn ngân hàng.',
            'account_number.required' => 'Số tài khoản là bắt buộc.',
            'account_number.numeric' => 'Số tài khoản phải là số.',
            'account_holder.regex' => 'Chủ tài khoản chỉ được chứa chữ cái in hoa, số và khoảng trắng.',
            'pin.required' => 'Mã PIN là bắt buộc.',
            'pin.numeric' => 'Mã PIN phải là số.',
            'pin.digits' => 'Mã PIN phải bao gồm 4 chữ số.',
        ];
    }
}
