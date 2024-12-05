<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\chuc_vu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Người Dùng";
        $query = User::with('chuc_vu'); // Nạp dữ liệu chức vụ

        $params['chucVus'] = chuc_vu::all();

        // Lọc trạng thái
        $query->when($request->filled('search_dm'), function ($q) use ($request) {
            $q->where('is_active', $request->input('search_dm'));
        });

        // Lọc theo tên, email, hoặc chức vụ
        $query->when($request->filled('search_product_name'), function ($q) use ($request) {
            $search = $request->input('search_product_name');
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('ho_ten', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('so_dien_thoai', 'like', "%{$search}%")
                    ->orWhereHas('chuc_vu', function ($cvQuery) use ($search) {
                        $cvQuery->where('ten_chuc_vu', 'like', "%{$search}%");
                    });
            });
        });

        // Truy vấn danh sách người dùng
        $params['title'] = $title;
        $params['list'] = $query->orderByDesc('id')->paginate(8);

        $isAdmin = auth()->user()->chuc_vu->ten_chuc_vu === 'admin';

        return view('admin.user.index', $params, compact('title', 'isAdmin'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $title = "Thêm mới nhân viên";
        $chuc_vus = chuc_vu::query()->pluck('ten_chuc_vu', 'id')->all();
        return view('admin.user.create', compact('title', 'chuc_vus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $params = $request->except('_token');
        if ($request->hasFile('anh_dai_dien')) {
            $img = $request->file('anh_dai_dien');
            $path = $img->store('images', 'public');
            $params['anh_dai_dien'] = $path;
        }
        User::create($params);
        session()->flash('success', 'Thêm mới nhân viên thành công!');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);  // Tìm đánh giá theo id
        // dd($danhgia);

        // Trả về view admin.danhgia.show với dữ liệu đánh giá
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Cập nhật";
        $user = User::query()->findOrFail($id);
        $chuc_vus = chuc_vu::query()->pluck('ten_chuc_vu', 'id')->all();
        return view('admin.user.edit', compact('user', 'title', 'chuc_vus'));
    }

    public function updateIs_active(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_active = $request->is_active;
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->authorize('update', User::class);
        // Validate dữ liệu từ form
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng ảnh
            'dia_chi' => 'nullable|string|max:255',
        ]);

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Cập nhật tên và địa chỉ người dùng
        $user->ho_ten = $request->ho_ten;
        $user->dia_chi = $request->dia_chi;

        // Xử lý ảnh đại diện nếu có
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($user->anh_dai_dien) {
                // Xóa ảnh cũ từ thư mục lưu trữ
                Storage::delete('public/' . $user->anh_dai_dien);
            }

            // Lưu ảnh mới vào thư mục 'public/storage/user'
            $imageName = time() . '_' . $request->file('anh_dai_dien')->getClientOriginalName();
            // Thay đổi đường dẫn lưu ảnh
            $path = $request->file('anh_dai_dien')->storeAs('user', $imageName, 'public');

            // Cập nhật đường dẫn ảnh đại diện trong cơ sở dữ liệu
            $user->anh_dai_dien = 'user/' . $imageName; // Chỉ lưu đường dẫn tương đối
        }

        // Lưu thay đổi vào cơ sở dữ liệu
        $user->save();

        // Trả về phản hồi thành công
        return response()->json(['success' => 'Cập nhật thành công']);
    }
    public function updatechucvu(Request $request, $userId)
    {

        $request->validate([
            'chuc_vu_id' => 'required|string|max:255'
        ]);
        $user = User::findOrFail($userId);
        $user->chuc_vu_id = $request->chuc_vu_id;
        $user->save();
        return response()->json(['success' => 'Cập nhật thành công']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
