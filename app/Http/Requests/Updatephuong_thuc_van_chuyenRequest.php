<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatephuong_thuc_van_chuyenRequest extends FormRequest
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
            'kieu_van_chuyen' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'kieu_van_chuyen.required' => 'Bạn chưa chọn phương thức vận chuyển',
        ];
    }
}
