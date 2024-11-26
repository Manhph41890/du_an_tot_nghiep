<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LienHeRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^(\+84|0)\d{9}$/',
            // Số điện thoại: 10 chữ số hoặc 11 nếu có mã quốc gia
            'subject' => 'required|in:support,order,feedback,complaint,other',
            'contact_message' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     */
    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là bắt buộc.',
            'name.string' => 'Họ và tên phải là chuỗi ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không đúng định dạng. 
            Vui lòng nhập số điện thoại Việt Nam với mã quốc gia (+84)
             hoặc bắt đầu bằng số 0 và có tối đa 10 chữ số.',
            'subject.required' => 'Tiêu đề là bắt buộc.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'subject.required' => 'Tiêu đề là bắt buộc.',
            'subject.in' => 'Tiêu đề không hợp lệ.',
            'contact_message.string' => 'Nội dung tin nhắn phải là chuỗi ký tự.',
            'contact_message.max' => 'Nội dung tin nhắn không được vượt quá 1000 ký tự.',
        ];
    }
}
