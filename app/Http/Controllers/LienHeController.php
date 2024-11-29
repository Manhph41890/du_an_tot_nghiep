<?php

namespace App\Http\Controllers;

use App\Http\Requests\LienHeRequest;
use App\Mail\ThankYouMail;
use App\Models\lien_he;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LienHeController extends Controller
{
    // đường dẫn vào form liên hệ
    public function create()
    {
        return view('client.lienhe');
    }
    // xử lý vấn đề khi khách hàng gửi form lh
    public function store(LienHeRequest $request)
    {

        // Kiểm tra nếu người dùng đã đăng nhập
        $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập (nếu có)

        // Nếu người dùng đã đăng nhập, không cần nhập lại name, email, phone
        $name = $user ? $user->ho_ten : $request->name;
        $email = $user ? $user->email : $request->email;
        $phone = $user ? $user->so_dien_thoai : $request->phone;

        // Lưu thông tin liên hệ vào cơ sở dữ liệu
        lien_he::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $request->subject,
            'contact_message' => $request->contact_message,
            'trang_thai' => 'Chưa xử lý', // Mặc định là chưa xử lý
        ]);
        // Gửi email cảm ơn
        // gửi vào email khách hàng nhập ở form 
        Mail::to($request->email)->send(new ThankYouMail($request->name));
        // Thông báo thành công và chuyển hướng
        // return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
        return redirect()->route('client.lienhe')->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }

    // Trong ContactController hoặc controller xử lý form


}
