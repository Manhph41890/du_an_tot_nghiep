<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storedanh_mucRequest extends FormRequest
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
            'ten_danh_muc'=> 'required|max:255',
            'anh_danh_muc'=>'nullable|image|mimes:jpg,png,jpeg,gif,webp',
            'is_active'=>'boolean|required',
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
            'ten_danh_muc.required'=> 'Tên danh mục là bắt buộc ',
            'ten_danh_muc.max'=> 'Tên danh mục không được vượt quá 255 ký tự ',

            'anh_danh_muc.nullable'=> 'Ảnh danh mục là bắt buộc ',
            'anh_danh_muc.image' => 'Hình ảnh không hợp lệ',
            'anh_danh_muc.mimes' => 'Hình ảnh phải là một trong các định dạng: jpg, png, jpeg, gif,webp',
        ];
    }   


}
