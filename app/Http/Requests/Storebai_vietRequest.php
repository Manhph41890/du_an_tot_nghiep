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
            'user_id' => ['required', Rule::exists('users', 'id')],
            'tieu_de_bai_viet' => 'required|max:255',
            'ngay_dang' => 'required|date',
            'noi_dung' => 'max:200',
            'anh_bai_viet' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => [Rule::in([0, 1])],
        ];
    }
}