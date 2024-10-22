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
            'ten_san_pham' => 'required|string|max:255|unique:san_phams,ten_san_pham',
            'gia_goc' => 'required|min:0',
            'gia_km' => 'nullable|min:0|lte:gia_goc', // Giá khuyến mãi không được lớn hơn giá gốc
            'ma_ta_san_pham' => 'max:255',
            'anh_san_pham' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',

            'is_active' => [Rule::in([0, 1])],
            'product_variants.*.color_san_pham' => 'nullable|string', // Đảm bảo kiểu dữ liệu
            'product_variants.*.size_san_pham' => 'nullable|string',
            'product_variants.*.so_luong' => 'nullable|integer|min:0',
            'product_variants.*.anh_bien_the' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'danh_muc_id.required' => 'Danh mục là bắt buộc.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá :max ký tự.',
            'ten_san_pham.unique' => 'Tên sản phẩm đã tồn tại.',
            'gia_goc.required' => 'Giá gốc là bắt buộc.',
            'gia_goc.min' => 'Giá gốc phải lớn hơn hoặc bằng 0.',
            'gia_km.required' => 'Giá khuyến mãi là bắt buộc.',
            'gia_km.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'gia_km.lte' => 'Giá khuyến mãi không được lớn hơn giá gốc.',
            'ma_ta_san_pham.max' => 'Mô tả sản phẩm không được vượt quá :max ký tự.',
            'anh_san_pham.required' => 'Ảnh sản phẩm là bắt buộc.',
            'anh_san_pham.mimes' => 'Ảnh sản phẩm phải có định dạng: jpeg, png, jpg, gif.',
            'anh_san_pham.max' => 'Ảnh sản phẩm không được vượt quá :max kilobytes.',
            'is_active.in' => 'Trạng thái không hợp lệ.',
            'product_variants.*.color_san_pham.nullable' => 'Màu có thể để trống.',
            'product_variants.*.size_san_pham.nullable' => 'Kích thước có thể để trống.',
            'product_variants.*.so_luong.nullable' => 'Số lượng có thể để trống.',
            'product_variants.*.so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'product_variants.*.anh_bien_the.mimes' => 'Ảnh biến thể phải có định dạng: jpeg, png, jpg, gif.',
            'product_variants.*.anh_bien_the.max' => 'Ảnh biến thể không được vượt quá :max kilobytes.',
            'product_variants.*.color_san_pham' => 'nullable|string', // Đảm bảo kiểu dữ liệu
            'product_variants.*.size_san_pham' => 'nullable|string',
            'product_variants.*.so_luong' => 'nullable|integer|min:0',
            'product_variants.*.anh_bien_the' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
