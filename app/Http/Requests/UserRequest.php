<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'chuc_vu_id' => 'required|integer|exists:chuc_vus,id',  // Kiểm tra chuc_vu_id tồn tại trong bảng chuc_vus
            'ho_ten' => 'required|string|max:255',
            'anh_dai_dien' => 'required|file|max:2048',  // Có thể không bắt buộc và chỉ cần là đường dẫn ngắn
            'email' => 'required|email|max:255|unique:users,email',  // Đảm bảo email hợp lệ và duy nhất
            'so_dien_thoai' => 'required|string|max:15',  // Giới hạn độ dài của số điện thoại
            'ngay_sinh' => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),  // Người dùng phải trên 18 tuổi
            'dia_chi' => 'required|string|max:255',
            'gioi_tinh' => 'required|in:nam,nu,Nam,Nữ,khac',  // Giới hạn các giá trị cho giới tính
            'password' => 'required|string|min:8',  // Tăng cường độ an toàn cho mật khẩu
            'is_active' => 'required|boolean',  // Xác định là giá trị boolean (0 hoặc 1)
        ];
    }
    public function messages(): array
    {
        return [
            'chuc_vu_id.required' => 'Vui lòng chọn chức vụ.',
            'chuc_vu_id.integer' => 'Chức vụ không hợp lệ.',
            'chuc_vu_id.exists' => 'Chức vụ không tồn tại trong hệ thống.',

            'ho_ten.required' => 'Vui lòng nhập họ tên.',
            'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'anh_dai_dien.max' => 'Đường dẫn ảnh đại diện không được vượt quá 2048 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',

            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 15 ký tự.',

            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh.',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',
            'ngay_sinh.before_or_equal' => 'Bạn phải trên 18 tuổi.',

            'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'gioi_tinh.required' => 'Vui lòng chọn giới tính.',
            'gioi_tinh.in' => 'Giới tính không hợp lệ.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',

            'is_active.required' => 'Vui lòng chọn trạng thái hoạt động.',
            'is_active.boolean' => 'Trạng thái hoạt động không hợp lệ.',
        ];
    }
}
