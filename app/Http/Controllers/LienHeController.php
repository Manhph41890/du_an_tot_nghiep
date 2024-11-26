<?php

namespace App\Http\Controllers;

use App\Http\Requests\LienHeRequest;
use App\Models\lien_he;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    // đường dẫn vào form liên hệ
    public function create()
    {
        return view('client.lien_he');
    }
    // xử lý vấn đề khi khách hàng gửi form lh
    public function store(LienHeRequest $request)
    {  
        
        // Lưu thông tin liên hệ vào cơ sở dữ liệu
        lien_he::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'contact_message' => $request->contact_message,
            'trang_thai' => 'Chưa xử lý', // Mặc định là chưa xử lý
        ]);

        // Thông báo thành công và chuyển hướng
        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}
