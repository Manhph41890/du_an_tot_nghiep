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
    public function index(Request $request)
    {
        $query = san_pham::query();

        // Kiểm tra xem có từ khóa tìm kiếm không
        if ($request->has('search') && !empty($request->search)) {
            $query->where('ten_san_pham', 'like', '%' . $request->search . '%');
        }
        // Kiểm tra xem có trạng thái được chọn không
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status);
        }

        $data = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color'])->paginate(10);
        $title = 'Danh sách sản phẩm';
        return view('admin.sanpham.index', compact('data', 'title'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesan_phamRequest $request)
    {
        DB::beginTransaction();
        try {
            // Lấy dữ liệu xác thực từ request
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

            // Xử lý biến thể sản phẩm và tổng số lượng
            $bien_the_san_phamsTmp = $request->input('product_variants', []);
            $totalQuantity = 0; // 

            if (!empty($bien_the_san_phamsTmp['size_san_pham']) && !empty($bien_the_san_phamsTmp['color_san_pham'])) {
                foreach ($bien_the_san_phamsTmp['size_san_pham'] as $key => $size_san_pham) {
                    // Kiểm tra và thêm kích thước vào bảng size_san_phams
                    $size = size_san_pham::firstOrCreate(['ten_size' => $size_san_pham]);
                    $size_san_pham_id = $size->id;

                    // Kiểm tra và thêm màu sắc vào bảng color_san_phams
                    $color_san_pham = $bien_the_san_phamsTmp['color_san_pham'][$key] ?? null;
                    $color = color_san_pham::firstOrCreate(['ten_color' => $color_san_pham]);
                    $color_san_pham_id = $color->id;

                    // Lấy số lượng biến thể
                    $quantity = $bien_the_san_phamsTmp['so_luong'][$key] ?? 0;
                    $totalQuantity += $quantity; // Cộng dồn số lượng biến thể

                    // Xử lý file ảnh biến thể
                    $anh_bien_the_path = null; // 

                    if ($request->hasFile("product_variants.anh_bien_the.$key")) {
                        $anh_bien_the_file = $request->file("product_variants.anh_bien_the.$key");
                        if ($anh_bien_the_file->isValid()) {
                            $filename = time() . '-' . $anh_bien_the_file->getClientOriginalName();
                            $anh_bien_the_path = $anh_bien_the_file->storeAs('sanphams', $filename, 'public');
                        } else {
                            return back()->withErrors(['product_variants' => 'File ảnh biến thể không hợp lệ']);
                        }
                    }

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

            // Cập nhật 
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


    private function handleImageUpload($request, $imageField)
    {
        if ($request->hasFile($imageField)) {
            $file = $request->file($imageField);
            if ($file->isValid()) {
                $filename = time() . '-' . $file->getClientOriginalName();
                return $file->storeAs('sanphams', $filename, 'public');
            } else {
                return null; // Không xử lý file không hợp lệ
            }
        }
        return null; // Nếu không có ảnh, trả về null
    }

    public function show(san_pham $san_pham, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Lấy sản phẩm theo ID
        $product = san_pham::with(['bien_the_san_phams.size', 'bien_the_san_phams.color'])->findOrFail($id);

        // Lấy danh sách danh mục, màu sắc và kích thước
        $danh_mucs = danh_muc::pluck('ten_danh_muc', 'id');
        $colors = color_san_pham::all(); // 
        $sizes = size_san_pham::all(); // 

        // 
        return view('admin.sanpham.edit', [
            'title' => 'Sửa sản phẩm',
            'product' => $product,
            'danh_mucs' => $danh_mucs,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesan_phamRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            // Tìm sản phẩm 
            $product = san_pham::findOrFail($id);
            $data_san_phams = $request->except('product_variants');

            // Xử lý ảnh sản phẩm chính
            if ($request->hasFile('anh_san_pham')) {
                $file = $request->file('anh_san_pham');
                if ($file->isValid()) {
                    // Xóa ảnh cũ nếu có
                    if ($product->anh_san_pham && Storage::disk('public')->exists($product->anh_san_pham)) {
                        Storage::disk('public')->delete($product->anh_san_pham);
                    }
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $data_san_phams['anh_san_pham'] = $file->storeAs('sanphams', $filename, 'public');
                } else {
                    return back()->withErrors(['anh_san_pham' => 'File không hợp lệ']);
                }
            } else {
                // Nếu không có ảnh sản phẩm, giữ nguyên giá trị ảnh cũ
                $data_san_phams['anh_san_pham'] = $product->anh_san_pham;
            }

            // Cập nhật thông tin sản phẩm
            $product->update($data_san_phams);

            // Xử lý biến thể sản phẩm và tính tổng số lượng
            $bien_the_san_phamsTmp = $request->input('product_variants', []);
            $totalQuantity = 0; // 

            // Xóa các biến thể cũ trước khi cập nhật
            $product->bien_the_san_phams()->delete();

            if (!empty($bien_the_san_phamsTmp['size_san_pham']) && !empty($bien_the_san_phamsTmp['color_san_pham'])) {
                foreach ($bien_the_san_phamsTmp['size_san_pham'] as $key => $size_san_pham) {
                    // Kiểm tra và thêm kích thước vào bảng size_san_phams
                    $size = size_san_pham::firstOrCreate(['ten_size' => $size_san_pham]);
                    $size_san_pham_id = $size->id;

                    // Kiểm tra và thêm màu sắc vào bảng color_san_phams
                    $color_san_pham = $bien_the_san_phamsTmp['color_san_pham'][$key] ?? null;
                    $color = color_san_pham::firstOrCreate(['ten_color' => $color_san_pham]);
                    $color_san_pham_id = $color->id;

                    // Lấy số lượng biến thể
                    $quantity = $bien_the_san_phamsTmp['so_luong'][$key] ?? 0;
                    $totalQuantity += $quantity; // 

                    // Xử lý file ảnh biến thể
                    $anh_bien_the_path = null; // 

                    if ($request->hasFile("product_variants.anh_bien_the.$key")) {
                        $anh_bien_the_file = $request->file("product_variants.anh_bien_the.$key");
                        if ($anh_bien_the_file->isValid()) {
                            $filename = time() . '-' . $anh_bien_the_file->getClientOriginalName();
                            $anh_bien_the_path = $anh_bien_the_file->storeAs('sanphams', $filename, 'public');
                        } else {
                            return back()->withErrors(['product_variants' => 'File ảnh biến thể không hợp lệ']);
                        }
                    }

                    // Tạo biến thể 
                    bien_the_san_pham::create([
                        'san_pham_id' => $product->id,
                        'size_san_pham_id' => $size_san_pham_id,
                        'color_san_pham_id' => $color_san_pham_id,
                        'anh_bien_the' => $anh_bien_the_path,
                        'so_luong' => $quantity,
                    ]);
                }
            }

            // Cập nhật 
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

            // Xóa tất cả biến thể 
            bien_the_san_pham::where('san_pham_id', $product->id)->delete();

            // Xóa sản phẩm chính
            $product->delete();

            DB::commit();

            return redirect()->route('sanphams.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            // 
            Log::error('Lỗi khi xóa sản phẩm: ' . $exception->getMessage() . ' - Line: ' . $exception->getLine() . ' - File: ' . $exception->getFile());
            return back()->withErrors('Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.');
        }
    }
}
