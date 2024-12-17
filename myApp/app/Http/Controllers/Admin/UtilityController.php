<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utility;
class UtilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilities = Utility::all();

        return view('admin_core.content.utility.index',compact('utilities'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_core.content.utility.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255', // Icon có thể là class của Font Awesome
        ]);

        // Tạo mới tiện ích
        $utility = new Utility();
        $utility->name = $request->name;
        $utility->description = $request->description;
        $utility->icon = $request->icon;
        $utility->save();

        return redirect()->back()->with('success', 'Tiện ích đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $utility = Utility::findOrFail($id);  // Lấy tiện ích theo ID
        return view('admin_core.content.utility.edit', compact('utility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu từ form
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable',
            'icon' => 'nullable|max:255',
        ]);

        // Lấy tiện ích cần chỉnh sửa
        $utility = Utility::findOrFail($id);

        // Cập nhật các thông tin tiện ích
        $utility->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        // Chuyển hướng về trang danh sách tiện ích với thông báo thành công
        return redirect()->route('admin.utilities.index')->with('success', 'Tiện ích đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $utility = Utility::findOrFail($id);  // Tìm tiện ích theo ID

        // Xóa tiện ích
        $utility->delete();

        // Quay lại trang danh sách với thông báo thành công
        return redirect()->back()->with('success', 'Tiện ích đã được xóa thành công.');
    }
}
