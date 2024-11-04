<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Lấy sản phẩm theo truy vấn
        $products = san_pham::where('ten_san_pham', 'like', "%{$query}%")
            ->take(5)
            ->where('is_active','1')
            ->get();
    
        // Thêm URL vào sản phẩm
        $products->transform(function ($product) {
            // Chỉnh sửa để sử dụng đúng trường ảnh
            $product->image_url = Storage::url($product->anh_san_pham); // Đường dẫn đến ảnh
            return $product;
        });
    
        return response()->json([
            'products' => $products,
        ]);
    }
}
