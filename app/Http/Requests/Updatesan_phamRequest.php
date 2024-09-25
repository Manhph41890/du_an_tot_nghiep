<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatesan_phamRequest extends FormRequest
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
            'ten_san_pham' => 'required|string|max:255',
            'gia_goc' => 'required|numeric|min:0',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
            'gia_km' => 'nullable|numeric|min:0',
            'ma_ta_san_pham' => 'nullable|string',
            'is_active' => 'required|boolean',
            'anh_san_pham' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
