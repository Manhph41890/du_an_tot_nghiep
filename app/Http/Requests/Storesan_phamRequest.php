<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Storesan_phamRequest extends FormRequest
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
            'danh_muc_id' => ['required', Rule::exists('danh_mucs', 'id')],
            'ten_san_pham' => 'required|max:255',
            'gia_goc' => 'required|min:0',
            'gia_km' => 'required|min:0',
            'ma_ta_san_pham' => 'max:255',
            'anh_san_pham' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',

            'is_active' => [Rule::in([0, 1])],
            'product_variants.*.color' => 'nullable', // Cho phép null
            'product_variants.*.size' => 'nullable',
            'product_variants.*.so_luong' => 'nullable',
            'product_variants.*.anh_bien_the' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',


        ];
    }
}