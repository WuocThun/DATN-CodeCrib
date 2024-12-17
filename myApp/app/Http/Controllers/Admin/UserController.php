<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function deleteUser($id)
    {
        // Kiểm tra User có tồn tại không
        $user = DB::table('users')->where('id', $id)->first();
        if ( ! $user) {
            return redirect()->route('users.list')
                             ->with('error', 'Người dùng không tồn tại.');
        }

        // Xóa User
        DB::table('users')->where('id', $id)->delete();

        return redirect()->back()->with('success',
            'Người dùng đã được xóa thành công.');
    }

    public function report(Request $request)
    {
        // Lấy dữ liệu từ request để xác định kiểu sắp xếp
        $sortBy = $request->get('sort_by',
            'created_at'); // Mặc định sắp xếp theo ngày tạo
        $order  = $request->get('order', 'desc'); // Mặc định là giảm dần

        // Tổng số lượng User
        $totalUsers = DB::table('users')->count();

        // Số lượng User VIP
        $vipUsers = DB::table('users')->where('is_vip', 1)->count();

        // Số dư trung bình
        $averageBalance = DB::table('users')->avg('balance');

        // Số lượng User có số dư lớn hơn 100.000
        $usersWithHighBalance = DB::table('users')
                                  ->where('balance', '>', 100000)->count();

        // Số lượng User đăng ký theo tháng
        $usersByMonth = DB::table('users')
                          ->select(DB::raw('MONTH(created_at) as month'),
                              DB::raw('COUNT(*) as total'))
                          ->groupBy('month')
                          ->orderBy('month')
                          ->get();

        // Số lượng User đã có trọ và chưa có trọ
        $usersWithMotel    = DB::table('users')->whereNotNull('motel_id')
                               ->count();
        $usersWithoutMotel = DB::table('users')->whereNull('motel_id')->count();

        // Truy vấn danh sách người dùng và sắp xếp theo tiêu chí
        //        $users = User::with(['motel.users'])
        //                     ->orderBy($sortBy, $order)
        //                     ->paginate(10);
        $users = DB::table('users')
                   ->leftJoin('motel', 'users.motel_id', '=', 'motel.id')
                   ->leftJoin('users as owners', 'motel.user_id', '=',
                       'owners.id') // 'owners' là alias
                   ->select('users.*', 'motel.name as motel_name',
                'owners.name as owner_name')
                   ->orderBy($sortBy, $order)
                   ->paginate(10);

        // Chuẩn bị dữ liệu cho biểu đồ
        $chartLabels = $usersByMonth->pluck('month')->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });
        $chartData   = $usersByMonth->pluck('total');

        return view('admin_core.content.users.user-report', compact(
            'totalUsers', 'vipUsers', 'averageBalance', 'usersWithHighBalance',
            'usersWithMotel', 'usersWithoutMotel', 'users', 'chartLabels',
            'chartData'
        ));
    }

    public function transferPayment()
    {
        return view('admin.content.payment.transfer_payment');
    }

    public function paymentIndex()
    {
        return view('admin.content.payment.payment_index');
    }

    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Lấy thông tin người dùng
        $user = auth()->user();

        // Lấy số tiền từ form
        $amount = $request->amount;

        // Cập nhật số dư tài khoản
        $user->balance += $amount;
        $user->save();

        return redirect()->back()->with('success', 'Nạp tiền thành công!');
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
    public function edit($id)
    {
        // Lấy thông tin người dùng theo ID
        $user = User::findOrFail($id);

        return view('admin_core.content.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Lấy thông tin người dùng theo ID
        $user = User::findOrFail($id);

        // Xác thực dữ liệu
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,'
                              . $id,
            'phone_number' => 'nullable|string|max:15',
            'balance'      => 'nullable',
            'avatar'       => 'nullable',
        ]);

        // Cập nhật thông tin người dùng
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone_number = $request->phone_number;
        $user->balance      = $request->balance;
            $get_image      = $request->avatar;
        if ($get_image) {
            $path           = 'uploads/users/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image     = current(explode('.', $get_name_image));
            $new_image      = $name_image . rand(0, 99) . '.'
                              . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $user->avatar = $new_image;
        };
        //        // Nếu có file ảnh, lưu trữ ảnh mới
        //        if ($request->hasFile('avatar')) {
        //            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        //            $user->avatar = $avatarPath;
        //        }

        $user->save();

        return redirect()->route('admin.dashboardCore', $user->id)
                         ->with('success',
                             'Cập nhật thông tin người dùng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back()->with('status', 'Bạn đã xoá thành công');
    }

}
