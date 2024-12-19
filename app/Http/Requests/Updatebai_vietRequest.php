<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Updatebai_vietRequest extends FormRequest
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
            'tieu_de_bai_viet' => 'required|string|max:255',
            'noi_dung' => 'required|string|max:5000',
            'anh_bai_viet' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'anh_bai_viet' => 'Ảnh bài viết là trường bắt buộc',
            'anh_bai_viet.mimes' => 'Hình ảnh phải là định dạng jpeg, png, jpg hoặc gif.',
            'anh_bai_viet.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',

            'tieu_de_bai_viet.required' => 'Tiêu đề bài viết là bắt buộc.',
            'tieu_de_bai_viet.max' => 'Tiêu đề bài viết không được vượt quá 255 ký tự.',

            'noi_dung.required' => 'Nội dung là bắt buộc.',
            'noi_dung.max' => 'Nội dung không được vượt quá 5,000 ký tự.',

            'is_active.required' => 'Trạng thái là bắt buộc.',
            'is_active.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
