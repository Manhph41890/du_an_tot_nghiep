<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storechuc_vuRequest extends FormRequest
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
            //
            'ten_chuc_vu' => 'required|max:255|unique:chuc_vus,ten_chuc_vu',
            'mo_ta_chuc_vu' => 'required|max:255',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            //
            'ten_chuc_vu.required' => 'Tên chức vụ là bắt buộc ',
            'ten_chuc_vu.max' => 'Tên chức vụ không được vượt quá 255 ký tự ',
            'ten_chuc_vu.unique' => 'Chức vụ đã tồn tại ',

            'mo_ta_chuc_vu.required' => 'Mô tả chức vụ là bắt buộc ',
            'mo_ta_chuc_vu.max' => 'Mô tả chức vụ không được vượt quá 255 ký tự ',

        ];
    }
}
