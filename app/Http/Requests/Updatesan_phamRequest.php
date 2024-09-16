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
            'gia_km' => 'nullable|numeric|min:0',
            'so_luong' => 'required|integer|min:0',
            'ma_ta_san_pham' => 'nullable|string',
            'is_active' => 'required|boolean',
            'anh_san_pham' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'bien_the_san_phams' => 'nullable|array',
            'bien_the_san_phams.*.size_san_pham_id' => 'required|integer|exists:sizes,id',
            'bien_the_san_phams.*.color_san_pham_id' => 'required|integer|exists:colors,id',
            'bien_the_san_phams.*.anh_bien_the' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
