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
        $data_san_phams = $request->except('anh_bien_the', 'bien_the_san_phams');
        $data_san_phams['is_active'] = isset($data['is_active']) ? 1 : 0;
        if ($data_san_phams['anh_san_pham']) {
            $data_san_phams['anh_san_pham'] = Storage::put('sanphams', $data_san_phams['anh_san_pham']);
        }
        $bien_the_san_phamsTmp = $request->product_variants;
        $bien_the_san_phams = [];
        foreach ($bien_the_san_phamsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $bien_the_san_phams[] = [
                'size_san_pham_id' => $tmp[0],
                'color_san_pham_id' => $tmp[1],
                'anh_bien_the' => $item['anh_bien_the'] ?? null,
            ];
        }
        try {

            DB::beginTransaction();


            /** @var san_pham $san_pham */
            $product = san_pham::query()->create($data_san_phams);

            foreach ($data_san_phams as $data_san_pham) {
                $data_san_pham['product_id'] = $product->id;
                if ($data_san_pham['anh_bien_the']) {
                    $data_san_pham['anh_bien_the'] = Storage::put('sanphams', $data_san_pham['anh_bien_the']);
                }
                bien_the_san_pham::query()->create($data_san_pham);
            }


            foreach ($data_san_phams as $item) {

                anh_san_pham::query()->create([
                    'san_pham_id' => $product->id,
                    'anh_san_pham' => Storage::put('sanphams', $item)
                ]);
            }

            DB::commit();

            return redirect()->route('sanphams.index');
        } catch (\Exception $exception) {
            DB::rollBack(); //
            return back();
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
