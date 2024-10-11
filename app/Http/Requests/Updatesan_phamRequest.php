<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'danh_muc_id' => ['required', Rule::exists('danh_mucs', 'id')],
            'gia_km' => 'nullable|numeric|min:0|lt:gia_goc', // Thêm điều kiện giá khuyến mãi nhỏ hơn giá gốc
            'ma_ta_san_pham' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'anh_san_pham' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_san_pham.string' => 'Tên sản phẩm phải là một chuỗi.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'gia_goc.required' => 'Giá gốc là bắt buộc.',
            'gia_goc.numeric' => 'Giá gốc phải là một số.',
            'gia_goc.min' => 'Giá gốc phải lớn hơn hoặc bằng 0.',
            'danh_muc_id.required' => 'Danh mục là bắt buộc.',
            'danh_muc_id.exists' => 'Danh mục không tồn tại.',
            'gia_km.numeric' => 'Giá khuyến mãi phải là một số.',
            'gia_km.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'gia_km.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'ma_ta_san_pham.string' => 'Mô tả sản phẩm phải là một chuỗi.',
            'ma_ta_san_pham.max' => 'Mô tả sản phẩm không được vượt quá 255 ký tự.',
            'is_active.required' => 'Trạng thái là bắt buộc.',
            'is_active.boolean' => 'Trạng thái phải là true hoặc false.',
            'anh_san_pham.image' => 'Hình ảnh phải là một file ảnh.',
            'anh_san_pham.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'anh_san_pham.max' => 'Hình ảnh không được vượt quá 2048 KB.',
        ];
    }
}