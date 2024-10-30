<?php

namespace App\Http\Controllers;

use App\Models\color_san_pham;
use App\Models\size_san_pham;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $title = "Quản lý biến thể";
        $colors = color_san_pham::all();
        $sizes = size_san_pham::all();
        return view('admin.variant.index', compact('colors', 'sizes', 'title'));
    }

    public function storeColor(Request $request)
    {
        $request->validate([
            'ten_color' => 'required|string|max:255',
            'ma_mau' => 'required|string|max:255',
        ]);

        color_san_pham::create([
            'ten_color' => $request->ten_color,
            'ma_mau' => $request->ma_mau,
        ]);

        return redirect()->back()->with('success', 'Thêm màu thành công!');
    }

    public function storeSize(Request $request)
    {
        $request->validate([
            'ten_size' => 'required|string|max:255',
        ]);

        size_san_pham::create([
            'ten_size' => $request->ten_size,
        ]);

        return redirect()->back()->with('success', 'Thêm kích thước thành công!');
    }

    public function editColor($id)
    {
        $color = color_san_pham::findOrFail($id);
        return response()->json($color);
    }

    public function updateColor(Request $request, $id)
    {
        $request->validate([
            'ten_color' => 'required|string|max:255',
            'ma_mau' => 'required|string|max:10|unique:color_san_phams,ma_mau,' . $id,
        ]);

        $color = color_san_pham::findOrFail($id);
        $color->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật màu thành công!');
    }

    public function destroyColor($colorId)
    {
        $color = color_san_pham::findOrFail($colorId);
        $color->delete();

        return redirect()->back()->with('success', 'Xóa màu thành công!');
    }

    public function editSize($id)
    {
        $size = size_san_pham::findOrFail($id);
        return response()->json($size);
    }

    public function updateSize(Request $request, $id)
    {
        $request->validate([
            'ten_size' => 'required|string|max:255',
        ]);

        $size = size_san_pham::findOrFail($id);
        $size->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật kích thước thành công!');
    }

    public function destroySize($id)
    {
        $size = size_san_pham::findOrFail($id);
        $size->delete();

        return redirect()->back()->with('success', 'Xóa kích thước thành công!');
    }
}