<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WheelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct()
//    {
//        $this->middleware('spin.cooldown');
//    }
//    public function index()
//    {
//        $user = Auth::user();
//
//        if ($user->last_spin_at && now()->diffInHours($user->last_spin_at) < 24) {
//            return redirect()->back()->with('error', 'Bạn chỉ được quay lại sau 24 giờ!');
//        }
//        return view('admin_core.content.wheel.index');
//    }
//    public function index()
//    {
//        $user = Auth::user();
//
//        $hoursLeft = null;
//
//        if ($user->last_spin_at && now()->diffInHours($user->last_spin_at) < 24) {
//            $hoursLeft = 17 + now()->diffInHours($user->last_spin_at);
//        }
//
//        return view('admin_core.content.wheel.index', compact('hoursLeft'));
//
//    }

        public function index()  {
            $user = Auth::user();

            $hoursLeft = null;

            if ($user->last_spin_at) {
                Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
                $hoursLeft = ( 24 + now('Asia/Ho_Chi_Minh')->diffInHours($user->last_spin_at)) *60*60; // 24 tiếng
                if ($hoursLeft < 24 * 60 * 60) { // Nếu chưa đủ 24 giờ
                    $hours = floor($hoursLeft / 3600) ;
                    $minutes = floor(($hoursLeft % 3600) / 60);
                    $seconds = $hoursLeft % 60;
                    $hoursLeft = "{$hours} giờ, {$minutes} phút, {$seconds} giây";
                }
            }

            return view('admin_core.content.wheel.index', compact('hoursLeft'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function spin(Request $request)
    {
        // Đảm bảo người dùng đã đăng nhập
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn cần đăng nhập để thực hiện quay!'
            ], 401);
        }

        $user = Auth::user();

        // Kiểm tra thời gian quay gần nhất
        $lastSpinAt = $user->last_spin_at;
        if ($lastSpinAt && now()->diffInHours($lastSpinAt) < 24) {
            $hoursLeft = 17 - now()->diffInHours($lastSpinAt);
            return response()->json([
                'status' => 'error',
                'message' => "Bạn chỉ có thể quay lại sau $hoursLeft giờ nữa!"
            ], 403);
        }

        // Đã qua 24 giờ, cho phép quay
        return response()->json([
            'status' => 'success',
            'message' => 'Bạn có thể quay!'
        ]);
    }

    public function reward(Request $request)
    {
        $reward = $request->query('reward');

        // Đảm bảo user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();

            // Kiểm tra thời gian quay cuối cùng
            if ($user->last_spin_at) {
                $lastSpinTime = \Carbon\Carbon::parse($user->last_spin_at);
                $currentTime = now('Asia/Ho_Chi_Minh');

                // Cộng thêm 24 giờ vào thời gian quay cuối cùng
                $nextSpinTime = $lastSpinTime->addHours(17);

                // Kiểm tra xem thời gian hiện tại có lớn hơn thời gian quay tiếp theo không
                if ($currentTime->lessThan($nextSpinTime)) {
                    $hoursLeft = $nextSpinTime->diffInHours($currentTime);
                    return redirect()->back()->with('error', 'Bạn cần đợi thêm ' . $hoursLeft . ' giờ nữa mới có thể quay lại!');
                }
            }

            // Xử lý logic cộng số dư dựa trên phần thưởng
            $rewardValues = [
                '+1k Vào tài khoản' => 1000,
                '+2k Vào tài khoản' => 2000,
                '+3k Vào tài khoản' => 3000,
                '+4k Vào tài khoản' => 4000,
                '+5k Vào tài khoản' => 5000,
                '+6k Vào tài khoản' => 6000,
                '+10k Vào tài khoản' => 10000,
                '+20k Vào tài khoản' => 20000,
            ];

            if (!array_key_exists($reward, $rewardValues)) {
                return redirect()->back()->with('error', 'Phần thưởng không hợp lệ!');
            }

            // Cộng số dư
            $user->balance += $rewardValues[$reward];

            // Cập nhật thời gian quay cuối cùng
            $user->last_spin_at = now('Asia/Ho_Chi_Minh');

            // Lưu thay đổi
            $user->save();

            // Chuyển hướng với thông báo thành công
            return redirect()->route('admin.wheel.index')->with('success', 'Bạn đã nhận ' . $reward);
        }
    }
}
