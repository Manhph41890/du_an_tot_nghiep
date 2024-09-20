<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use App\Http\Requests\Storesan_phamRequest;
use App\Http\Requests\Updatesan_phamRequest;
use App\Models\anh_san_pham;
use App\Models\bien_the_san_pham;
use App\Models\color_san_pham;
use App\Models\danh_muc;
use App\Models\size_san_pham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

        $danh_mucs = danh_muc::query()->pluck('ten_danh_muc', 'id')->all();
        $colors = color_san_pham::query()->pluck('ten_color', 'id')->all();
        $sizes = size_san_pham::whereNotNull('ten_size')->whereNotNull('id')->pluck('ten_size', 'id')->all();
        $title = "Thêm mới sản phẩm";

        return view('admin.sanpham.create', compact('danh_mucs', 'colors', 'sizes', 'title'));
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
    public function show(san_pham $san_pham, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(san_pham $san_pham, $id)
    {
        // Tìm sản phẩm theo ID
        $product = san_pham::findOrFail($id);

        // Truyền dữ liệu sản phẩm tới view
        return view('sanphams.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesan_phamRequest $request, $id)
    {
        // Lấy sản phẩm từ ID
        $product = san_pham::findOrFail($id);

        // Lấy dữ liệu đã được xác thực từ request
        $data_san_phams = $request->except('product_variants');

        // Xử lý ảnh sản phẩm chính
        if ($request->hasFile('anh_san_pham')) {
            $file = $request->file('anh_san_pham');
            if ($file->isValid()) {
                // Xóa ảnh cũ nếu có
                if ($product->anh_san_pham) {
                    Storage::disk('public')->delete($product->anh_san_pham);
                }
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
            if (isset($item['anh_bien_the'])) {
                $anh_bien_the_file = $item['anh_bien_the'];
                if ($anh_bien_the_file instanceof \Illuminate\Http\UploadedFile && $anh_bien_the_file->isValid()) {
                    // Xóa ảnh cũ nếu có
                    if (isset($item['old_anh_bien_the']) && $item['old_anh_bien_the']) {
                        Storage::disk('public')->delete($item['old_anh_bien_the']);
                    }
                    $anh_bien_the_path = $anh_bien_the_file->store('sanphams', 'public');
                }
            }

            $bien_the_san_phams[] = [
                'size_san_pham_id' => $tmp[0],
                'color_san_pham_id' => $tmp[1],
                'anh_bien_the' => $anh_bien_the_path,
            ];
        }

        try {
            DB::beginTransaction();

            // Cập nhật sản phẩm chính
            $product->update($data_san_phams);

            // Xóa biến thể sản phẩm cũ
            bien_the_san_pham::where('san_pham_id', $product->id)->delete();

            // Tạo biến thể sản phẩm mới
            foreach ($bien_the_san_phams as $bien_the) {
                $bien_the['san_pham_id'] = $product->id; // Thêm san_pham_id vào biến thể
                bien_the_san_pham::create($bien_the);
            }

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Ghi log lỗi với thông tin chi tiết
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile());
            return back()->withErrors('Đã xảy ra lỗi khi cập nhật sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Lấy sản phẩm từ ID
            $product = san_pham::findOrFail($id);

            // Xóa ảnh sản phẩm chính nếu có
            if ($product->anh_san_pham) {
                Storage::disk('public')->delete($product->anh_san_pham);
            }

            // Xóa tất cả biến thể của sản phẩm
            bien_the_san_pham::where('san_pham_id', $product->id)->delete();

            // Xóa sản phẩm chính
            $product->delete();

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Ghi log lỗi với thông tin chi tiết
            Log::error('Lỗi khi xóa sản phẩm: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile());
            return back()->withErrors('Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.');
        }
    }
}
