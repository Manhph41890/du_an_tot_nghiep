<?php

namespace App\Http\Controllers;

use App\Models\danh_muc;
use App\Models\san_pham;
use App\Http\Requests\Storesan_phamRequest;
use App\Http\Requests\Updatesan_phamRequest;
use App\Models\anh_san_pham;
use App\Models\bien_the_san_pham;
use App\Models\color_san_pham;
use App\Models\size_san_pham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = san_pham::query()->with('danh_muc')->latest('id')->paginate(5);
        // dd($data);
        $title = 'Danh Sách Sản Phẩm';
        return view('admin.sanpham.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesan_phamRequest $request)
    {

        // Lấy dữ liệu đã được xác thực từ request
        $data_san_phams = $request->except('product_variants');

        // Xử lý ảnh sản phẩm chính
        if ($request->hasFile('anh_san_pham')) {
            $file = $request->file('anh_san_pham');
            if ($file->isValid()) {
                // Lưu file với tên chính thức
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('sanphams', $filename, 'public');
                $data_san_phams['anh_san_pham'] = $path;
            } else {
                // Xử lý lỗi nếu file không hợp lệ
                return back()->withErrors(['anh_san_pham' => 'File không hợp lệ']);
            }
        }

        // Lấy biến thể sản phẩm từ request
        $bien_the_san_phamsTmp = $request->input('product_variants', []);
        $bien_the_san_phams = [];

        // Xử lý từng biến thể trong mảng product_variants
        foreach ($bien_the_san_phamsTmp as $key => $item) {
            $tmp = explode('-', $key); // Tách size_san_pham_id và color_san_pham_id từ key
            $anh_bien_the_path = null;

            // Xử lý file ảnh biến thể
            if (request()->hasFile('product_variants.1-2.anh_bien_the')) {
                $anh_bien_the_file = request()->file('product_variants.1-2.anh_bien_the');
                if ($anh_bien_the_file->isValid()) {
                    $anh_bien_the_path = $anh_bien_the_file->store('sanphams');
                } else {
                    dd('File is not valid');
                }
            } else {
                dd('No file uploaded');
            }




            $bien_the_san_phams[] = [
                'size_san_pham_id' => $tmp[0],
                'color_san_pham_id' => $tmp[1],
                'anh_bien_the' => $anh_bien_the_path,
            ];
        }

        try {
            DB::beginTransaction();

            // Tạo sản phẩm chính
            $product = san_pham::create($data_san_phams);

            // Tạo biến thể sản phẩm
            foreach ($bien_the_san_phams as $bien_the) {
                $bien_the['san_pham_id'] = $product->id; // Thêm san_pham_id vào biến thể
                bien_the_san_pham::create($bien_the);
            }

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Ghi log lỗi với thông tin chi tiết
            Log::error('Lỗi khi thêm sản phẩm: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile());
            return back()->withErrors('Đã xảy ra lỗi khi thêm sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(san_pham $san_pham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(san_pham $san_pham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesan_phamRequest $request, san_pham $san_pham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(san_pham $san_pham)
    {
        //
    }
}
