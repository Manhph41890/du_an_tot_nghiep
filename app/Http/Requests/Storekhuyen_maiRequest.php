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
            'ten_khuyen_mai' => 'required|max:255',
            'gia_tri_khuyen_mai' => 'required|numeric|min:0',
            'so_luong_ma' => 'required|integer|min:1',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'is_active' => 'required|boolean',

        ];
    }


    public function messages()
    {
        return [
            //
            'ten_khuyen_mai.required' => 'Tên khuyến mãi không được để trống',
            'ten_khuyen_mai.max' => 'Tên khuyến mãi không được quá 255 ký tự',

            'gia_tri_khuyen_mai.required' => 'Gía trị khyến mãi không được để trống',
            'gia_tri_khuyen_mai.numeric' => 'Giá trị khuyến mãi không phải là số',
            'gia_tri_khuyen_mai.min' => 'Giá trị khuyến mãi không được nhỏ hơn 0',
            // 'gia_tri_khuyen_mai.max' => 'Giá trị khuyến mãi không được lớn hơn 100',

            'so_luong_ma.required' => 'Số lượng khyến mãi không được để trống',
            'so_luong_ma.integer' => 'Số lượng khyến mãi không phải số',
            'so_luong_ma.min' => 'Số lượng khyến mãi không được nhỏ hơn 0',

            'ngay_bat_dau.required' => 'Ngày bắt đầu không được để trống',
            'ngay_bat_dau.date' => 'Ngày bắt đầu không phải ngày',

            'ngay_ket_thuc.required' => 'Ngày kết thúc không được để trống',
            'ngay_ket_thuc.date' => 'Ngày kết thúc không phải ngày',
            'ngay_ket_thuc.after' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu',

            'is_active' => 'Trạng thái không được để trống',

        ];
    }
}