<?php

namespace App\Http\Requests;

use App\Models\don_hang;
use Illuminate\Foundation\Http\FormRequest;

class Updatedon_hangRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'san_pham_id' => 'nullable|exists:san_phams,id',
            'khuyen_mai_id' => 'nullable|exists:khuyen_mais,id',
            'phuong_thuc_thanh_toan_id' => 'nullable|exists:phuong_thuc_thanh_toans,id',
            'phuong_thuc_van_chuyen_id' => 'nullable|exists:phuong_thuc_van_chuyen,id',
            'ngay_tao' => 'nullable|date',
            'tong_tien' => 'nullable|numeric|min:0', // Số tiền phải là số dương
            'ho_ten' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
            'dia_chi' => 'nullable|string|max:255',
            'trang_thai' => 'nullable|in:Đặt hàng thành công,Đang chuẩn bị hàng,Đang vận chuyển,Đã giao',
        ];
    }
}
