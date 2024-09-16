<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storekhuyen_maiRequest extends FormRequest
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
            'ten_khuyen_mai' => 'required|string|max:255',
            
                      // Giá trị khuyến mãi tùy chỉnh
            'gia_tri_khuyen_mai' => 'required|numeric|min:0', 
                      // Số lượng mã tùy chỉnh
            'so_luong_ma' => 'required|integer|min:1', 
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'is_active' => 'required|boolean',
        ];
    }
}
