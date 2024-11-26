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
        $lienHe = new lien_he();
        $lienHe->name = $request->name;
        $lienHe->email = $request->email;
        $lienHe->phone = $request->phone;
        $lienHe->subject = $request->subject;
        $lienHe->contact_message = $request->contact_message;
        $lienHe->trang_thai = 'Chưa xử lý';
        $lienHe->save();

        // Thông báo thành công và chuyển hướng
        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}
