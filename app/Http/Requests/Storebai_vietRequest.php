<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Storebai_vietRequest extends FormRequest
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
            'tieu_de_bai_viet' => 'required|max:255',
            'ngay_dang' => 'required|date',
            'noi_dung' => 'max:200',
            'anh_bai_viet' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => [Rule::in([0, 1])],
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
            'anh_bai_viet.mimes' => 'Hình ảnh phải là định dạng jpeg, png, jpg hoặc gif.',
            'anh_bai_viet.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',

            'tieu_de_bai_viet.required' => 'Tiêu đề bài viết là bắt buộc.',
            'tieu_de_bai_viet.max' => 'Tiêu đề bài viết không được vượt quá 255 ký tự.',

            'noi_dung.required' => 'Nội dung là bắt buộc.',
            'noi_dung.max' => 'Nội dung không được vượt quá 1000 ký tự.',

            'user_id.exists' => 'Tác giả không tồn tại.',

            'ngay_dang.date' => 'Ngày đăng phải là định dạng ngày hợp lệ.',

            'is_active.required' => 'Trạng thái là bắt buộc.',
            'is_active.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}