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
        $data_san_phams = $request->except('anh_bien_the', 'bien_the_san_phams');

        // Xử lý ảnh sản phẩm
        if ($request->hasFile('anh_san_pham')) {
            $data_san_phams['anh_san_pham'] = Storage::put('sanphams', $request->file('anh_san_pham'));
        }

        // Chuyển đổi biến thể sản phẩm
        $bien_the_san_phamsTmp = $request->input('product_variants', []);
        $bien_the_san_phams = [];

        if (is_array($bien_the_san_phamsTmp)) {
            foreach ($bien_the_san_phamsTmp as $key => $item) {
                $tmp = explode('-', $key);
                $bien_the_san_phams[] = [
                    'size_san_pham_id' => $tmp[0],
                    'color_san_pham_id' => $tmp[1],
                    'anh_bien_the' => isset($item['anh_bien_the']) ? Storage::put('sanphams', $item['anh_bien_the']) : null,
                ];
            }
        }

        try {
            DB::beginTransaction();

            // Tạo sản phẩm chính
            $product = san_pham::create($data_san_phams);

            // Xử lý biến thể sản phẩm
            foreach ($bien_the_san_phams as $bien_the) {
                $bien_the['san_pham_id'] = $product->id;
                bien_the_san_pham::create($bien_the);
            }

            // Xử lý ảnh của sản phẩm
            if (isset($data_san_phams['anh_san_pham'])) {
                anh_san_pham::create([
                    'san_pham_id' => $product->id,
                    'anh_san_pham' => $data_san_phams['anh_san_pham']
                ]);
            }

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Ghi log lỗi
            Log::error('Lỗi khi thêm sản phẩm: ' . $exception->getMessage());
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
    public function update(Updatesan_phamRequest $request, san_pham $san_pham)
    {
        $product = san_pham::findOrFail('id');

        // Xử lý dữ liệu từ request
        $data_san_phams = $request->except('anh_bien_the', 'product_variants');

        // Xử lý trạng thái
        $data_san_phams['is_active'] = $request->input('is_active', 0); // Mặc định là 0 nếu không có giá trị

        // Xử lý ảnh sản phẩm
        if ($request->hasFile('anh_san_pham')) {
            // Xóa ảnh cũ nếu có
            if ($product->anh_san_pham) {
                Storage::delete($product->anh_san_pham);
            }
            $data_san_phams['anh_san_pham'] = Storage::put('sanphams', $request->file('anh_san_pham'));
        }

        // Xử lý biến thể sản phẩm
        $bien_the_san_phamsTmp = $request->input('product_variants', []);
        $bien_the_san_phams = [];

        if (is_array($bien_the_san_phamsTmp)) {
            foreach ($bien_the_san_phamsTmp as $key => $item) {
                $tmp = explode('-', $key);
                $bien_the_san_phams[] = [
                    'size_san_pham_id' => $tmp[0],
                    'color_san_pham_id' => $tmp[1],
                    'anh_bien_the' => isset($item['anh_bien_the']) ? Storage::put('sanphams', $item['anh_bien_the']) : null,
                ];
            }
        }

        try {
            DB::beginTransaction();

            // Cập nhật sản phẩm chính
            $product->update($data_san_phams);

            // Xóa các biến thể cũ nếu cần
            bien_the_san_pham::where('san_pham_id', $product->id)->delete();

            // Thêm biến thể sản phẩm mới
            foreach ($bien_the_san_phams as $bien_the) {
                $bien_the['san_pham_id'] = $product->id;
                bien_the_san_pham::create($bien_the);
            }

            // Xóa ảnh cũ của sản phẩm nếu có và thêm ảnh mới
            anh_san_pham::where('san_pham_id', $product->id)->delete();
            if (isset($data_san_phams['anh_san_pham'])) {
                anh_san_pham::create([
                    'san_pham_id' => $product->id,
                    'anh_san_pham' => $data_san_phams['anh_san_pham']
                ]);
            }

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $exception->getMessage());
            return back()->withErrors('Đã xảy ra lỗi khi cập nhật sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(san_pham $san_pham, $id)
    {
        try {
            // Tìm sản phẩm theo ID
            $product = $san_pham::findOrFail($id);

            // Xóa các ảnh liên quan (nếu có)
            if ($product->anh_san_pham) {
                Storage::delete($product->anh_san_pham);
            }

            // Xóa các biến thể của sản phẩm
            bien_the_san_pham::where('san_pham_id', $product->id)->delete();

            // Xóa sản phẩm
            $product->delete();

            // Cung cấp phản hồi thành công
            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $exception) {
            // Xử lý lỗi và cung cấp phản hồi lỗi
            Log::error('Lỗi khi xóa sản phẩm: ' . $exception->getMessage());
            return back()->withErrors('Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.');
        }
    }
}
