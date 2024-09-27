<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storesan_phamRequest;
use App\Http\Requests\Updatesan_phamRequest;
use App\Models\bien_the_san_pham;

use App\Models\danh_muc;
use App\Models\san_pham;
use App\Models\color_san_pham;
use App\Models\size_san_pham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $danhmucs = danh_muc::query()->get();
        $query = san_pham::query();

        // search theo trạng thái
        if ($request->has('search_sp')) {
            $is_active = $request->input('search_sp');
            if ($is_active == '1' || $is_active == '0') {
                $query->where('is_active', $is_active);
            }
        }

        // search theo danh mục
        if ($request->has('search_sp_dm')) {
            $dm = $request->input('search_sp_dm');
            if ($dm) {
                $query->where('danh_muc_id', $dm);
            }
        }

        // search form input
        if ($request->has('search_sp_ten')) {
            $query->where('ten_san_pham', 'LIKE', "%{$request->input('search_sp_ten')}%");
        }

        $data = $query->with('danh_muc')->latest('id')->paginate(5);
        // dd($data);
        $title = 'Danh Sách Sản Phẩm';
        return view('admin.sanpham.index', compact('data', 'title', 'danhmucs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danh_mucs = danh_muc::query()->pluck('ten_danh_muc', 'id')->all();
        $sizes = size_san_pham::pluck('ten_size', 'id')->all(); // Lấy tên size và id
        $colors = color_san_pham::pluck('ten_color', 'id')->all(); // Lấy tên color và id
        $title = "Thêm mới sản phẩm";
        return view('admin.sanpham.create', compact('danh_mucs', 'colors', 'sizes', 'title'));
    }

    public function store(Storesan_phamRequest $request)
    {
        DB::beginTransaction();
        try {
            // Lấy dữ liệu đã được xác thực từ request
            $data_san_phams = $request->except('product_variants');

            // Xử lý ảnh sản phẩm chính
            if ($request->hasFile('anh_san_pham')) {
                $file = $request->file('anh_san_pham');
                if ($file->isValid()) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $data_san_phams['anh_san_pham'] = $file->storeAs('sanphams', $filename, 'public');
                } else {
                    return back()->withErrors(['anh_san_pham' => 'File không hợp lệ']);
                }
            } else {
                // Nếu không có ảnh sản phẩm, set ảnh sản phẩm là null
                $data_san_phams['anh_san_pham'] = null;
            }

            // Tạo sản phẩm chính
            $product = san_pham::create($data_san_phams);

            // Xử lý biến thể sản phẩm và tính tổng số lượng
            $bien_the_san_phamsTmp = $request->input('product_variants', []);
            $totalQuantity = 0; // Khởi tạo biến để tính tổng số lượng

            if (!empty($bien_the_san_phamsTmp)) {
                foreach ($bien_the_san_phamsTmp as $key => $item) {
                    $tmp = explode('-', $key);
                    if (count($tmp) < 2) {
                        return back()->withErrors(['product_variants' => 'Dữ liệu biến thể không hợp lệ']);
                    }

                    $size_san_pham_id = $tmp[0];
                    $color_san_pham_id = $tmp[1];
                    $anh_bien_the_path = null;

                    // Xử lý file ảnh biến thể
                    if ($request->hasFile("product_variants.$key.anh_bien_the")) {
                        $anh_bien_the_file = $request->file("product_variants.$key.anh_bien_the");
                        if ($anh_bien_the_file->isValid()) {
                            $filename = time() . '-' . $anh_bien_the_file->getClientOriginalName();
                            $anh_bien_the_path = $anh_bien_the_file->storeAs('sanphams', $filename, 'public');
                        } else {
                            return back()->withErrors(['product_variants' => 'File ảnh biến thể không hợp lệ']);
                        }
                    }

                    // Lấy số lượng biến thể
                    $quantity = $item['so_luong'] ?? 0;
                    $totalQuantity += $quantity; // Cộng dồn số lượng biến thể

                    // Tạo biến thể sản phẩm
                    bien_the_san_pham::create([
                        'san_pham_id' => $product->id,
                        'size_san_pham_id' => $size_san_pham_id,
                        'color_san_pham_id' => $color_san_pham_id,
                        'anh_bien_the' => $anh_bien_the_path,
                        'so_luong' => $quantity,
                    ]);
                }
            }

            // Cập nhật tổng số lượng sản phẩm chính
            $product->so_luong = $totalQuantity;
            $product->save();

            DB::commit();
            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi khi thêm sản phẩm: ' . $exception->getMessage());
            return back()->withErrors('Đã xảy ra lỗi khi thêm sản phẩm. Vui lòng thử lại.');
        }
    }


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
        $danh_mucs = danh_muc::pluck('ten_danh_muc', 'id');
        $sizes = size_san_pham::pluck('ten_size', 'id')->all(); // Lấy tên size và id
        $colors = color_san_pham::pluck('ten_color', 'id')->all(); // Lấy tên color và id
        // Truyền dữ liệu sản phẩm tới view
        return view('admin.sanpham.edit', compact('product', 'danh_mucs', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesan_phamRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            // Tìm sản phẩm cần cập nhật
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

                    $filename = time() . '-' . $file->getClientOriginalName();
                    $data_san_phams['anh_san_pham'] = $file->storeAs('sanphams', $filename, 'public');
                } else {
                    return back()->withErrors(['anh_san_pham' => 'File không hợp lệ']);
                }
            }

            // Cập nhật thông tin sản phẩm
            $product->update($data_san_phams);

            // Xử lý biến thể sản phẩm và tính tổng số lượng
            $bien_the_san_phamsTmp = $request->input('product_variants', []);
            $totalQuantity = 0; // Khởi tạo biến để tính tổng số lượng

            // Xóa các biến thể cũ trước khi cập nhật
            $product->bien_the_san_phams()->delete();

            if (!empty($bien_the_san_phamsTmp)) {
                foreach ($bien_the_san_phamsTmp as $key => $item) {
                    $tmp = explode('-', $key);
                    if (count($tmp) < 2) {
                        return back()->withErrors(['product_variants' => 'Dữ liệu biến thể không hợp lệ']);
                    }

                    $size_san_pham_id = $tmp[0];
                    $color_san_pham_id = $tmp[1];
                    $anh_bien_the_path = null;

                    // Xử lý file ảnh biến thể
                    if ($request->hasFile("product_variants.$key.anh_bien_the")) {
                        $anh_bien_the_file = $request->file("product_variants.$key.anh_bien_the");
                        if ($anh_bien_the_file->isValid()) {
                            $filename = time() . '-' . $anh_bien_the_file->getClientOriginalName();
                            $anh_bien_the_path = $anh_bien_the_file->storeAs('sanphams', $filename, 'public');
                        } else {
                            return back()->withErrors(['product_variants' => 'File ảnh biến thể không hợp lệ']);
                        }
                    }

                    // Lấy số lượng biến thể
                    $quantity = $item['so_luong'] ?? 0;
                    $totalQuantity += $quantity; // Cộng dồn số lượng biến thể

                    // Tạo biến thể sản phẩm
                    bien_the_san_pham::create([
                        'san_pham_id' => $product->id,
                        'size_san_pham_id' => $size_san_pham_id,
                        'color_san_pham_id' => $color_san_pham_id,
                        'anh_bien_the' => $anh_bien_the_path,
                        'so_luong' => $quantity,
                    ]);
                }
            }

            // Cập nhật tổng số lượng sản phẩm chính
            $product->so_luong = $totalQuantity;
            $product->save();

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
