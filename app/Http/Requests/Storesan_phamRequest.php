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
        return false;
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
            'anh_san_pham' => 'required|image',
            'gia_goc' => 'required|min:0',
            'gia_km' => 'required|min:0',
            'ma_ta_san_pham' => 'max:255',
            'is_active' => [Rule::in([0, 1])],
            'color_san_pham' => 'required|max:255',
            'size_san_pham' => 'required|max:255',
            'anh_bien_the' => 'required|image',

        ];
    }
}
