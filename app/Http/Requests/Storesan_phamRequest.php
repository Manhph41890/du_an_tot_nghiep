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
     */
    public function rules(): array
    {
        return [
            'danh_muc_id' => ['required', Rule::exists('danh_mucs', 'id')],
            'ten_san_pham' => 'required|string|max:255|unique:san_phams,ten_san_pham',
            'gia_goc' => 'required|min:0',
            'gia_km' => 'nullable|min:0|lte:gia_goc',
            'gia_nhap' => 'required|min:0|lte:gia_goc',
            'ma_ta_san_pham' => 'required',
            'anh_san_pham' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => [Rule::in([0, 1])],

            'product_variants.size_san_pham.*' => 'required|exists:size_san_phams,id',
            'product_variants.color_san_pham.*' => 'required|exists:color_san_phams,id',
            'product_variants.so_luong.*' => 'required|integer|min:0',
            'product_variants.gia.*' => 'required|numeric|min:0',
            'product_variants.anh_bien_the.*' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Configure the validator instance to check for duplicate variants.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $sizes = $this->input('product_variants.size_san_pham', []);
            $colors = $this->input('product_variants.color_san_pham', []);

            $uniqueVariants = [];
            foreach ($sizes as $index => $size) {
                $color = $colors[$index] ?? null;
                if ($size && $color) {
                    $variantKey = $size . '-' . $color;
                    if (in_array($variantKey, $uniqueVariants)) {
                        $validator->errors()->add(
                            'product_variants',
                            'Có sự trùng lặp giữa màu sắc và kích thước tại dòng ' . ($index + 1) . '.'
                        );
                    }
                    $uniqueVariants[] = $variantKey;
                }
            }
        });
    }

    /**
     * Get the validation messages that apply to the request.
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
            'gia_km.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'gia_km.lte' => 'Giá khuyến mãi không được lớn hơn giá gốc.',
            'gia_nhap.required' => 'Giá nhập là bắt buộc.',
            'gia_nhap.min' => 'Giá nhập phải lớn hơn hoặc bằng 0.',
            'gia_nhap.lte' => 'Giá nhập không được lớn hơn giá gốc.',
            'ma_ta_san_pham.required' => 'Mô tả sản phẩm là bắt buộc.',
            'ma_ta_san_pham.max' => 'Mô tả sản phẩm không được vượt quá :max ký tự.',
            'anh_san_pham.required' => 'Ảnh sản phẩm là bắt buộc.',
            'anh_san_pham.mimes' => 'Ảnh sản phẩm phải có định dạng: jpeg, png, jpg, gif.',
            'anh_san_pham.max' => 'Ảnh sản phẩm không được vượt quá :max kilobytes.',
            'is_active.in' => 'Trạng thái không hợp lệ.',

            'product_variants.*.color_san_pham.required' => 'Màu không thể để trống.',
            'product_variants.*.color_san_pham.exists' => 'Màu đã chọn không hợp lệ.',
            'product_variants.*.size_san_pham.required' => 'Kích thước không thể để trống.',
            'product_variants.*.size_san_pham.exists' => 'Kích thước đã chọn không hợp lệ.',
            'product_variants.*.so_luong.required' => 'Số lượng không thể để trống.',
            'product_variants.*.so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'product_variants.*.gia.required' => 'Giá biến thể là bắt buộc.',
            'product_variants.*.gia.numeric' => 'Giá biến thể phải là một số.',
            'product_variants.*.gia.min' => 'Giá biến thể phải lớn hơn hoặc bằng 0.',
            'product_variants.*.anh_bien_the.required' => 'Ảnh biến thể là bắt buộc.',
            'product_variants.*.anh_bien_the.mimes' => 'Ảnh biến thể phải có định dạng: jpeg, png, jpg, gif.',
            'product_variants.*.anh_bien_the.max' => 'Ảnh biến thể không được vượt quá :max kilobytes.',
        ];
    }
}
