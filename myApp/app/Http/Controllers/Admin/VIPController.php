<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\VIPPackage;
use App\Models\VIPPurchase;
use App\Models\VIPBenefits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class VIPController extends Controller
{
//    public function purchaseVIPPackage(Request $request, $roomId,$vipPackageId)
//    {
//        $request->validate([
//            'vip_package_id' => 'required|exists:vip_packages,id',
//        ]);
//
//        $room = Rooms::findOrFail($roomId);
//        $user = auth()->user(); // Lấy thông tin người dùng đang đăng nhập
//        $vipPackage = VipPackage::findOrFail($vipPackageId);
//        $benefits = $vipPackage->benefits;
//
////        $vipPackage = VIPPackage::findOrFail($request->vip_package_id);
//        if ($user->balance < $vipPackage->price) {
//            return back()->with('error', 'Số dư không đủ để mua gói VIP.');
//        }
//        $user->balance -= $vipPackage->price;
//        $user->is_vip = true; // Kích hoạt trạng thái VIP cho người dùng
//        $user->save();
//        // Calculate start and end dates
//        $startDate = Carbon::now();
//        $endDate = $startDate->copy()->addDays($vipPackage->duration_days);
//
//        // Create a VIP purchase record
//        VIPPurchase::create([
//            'room_id' => $room->id,
//            'user_id' => auth()->id(),
//            'vip_package_id' => $vipPackage->id,
//            'start_date' => $startDate,
//            'end_date' => $endDate,
//            'status' => 'active',
//        ]);
//
//        // Optionally, update the room status or visibility
//        $room->vip_package_id = $vipPackage->id;
//        $room->status = 1; // Set an appropriate status for boosted visibility
//        $room->save();
//
//        return redirect()->back()->with('success', 'VIP package purchased successfully!');
//    }
//    public function purchaseVIPPackage(Request $request, $roomId, $vipPackageId)
//    {
//        // Validate input
//        $request->validate([
//            'vip_package_id' => 'required|exists:vip_packages,id',
//        ]);
//
//        // Lấy phòng và người dùng
//        $room = Rooms::findOrFail($roomId);
//        $user = auth()->user();
//        $vipPackage = VipPackage::findOrFail($vipPackageId);
//        $benefits = $vipPackage->benefits; // Lấy quyền lợi của gói VIP
//
//        // Kiểm tra số dư của người dùng
//        if ($user->balance < $vipPackage->price) {
//            return back()->with('error', 'Số dư không đủ để mua gói VIP.');
//        }
//
//        // Trừ tiền trong tài khoản người dùng và cập nhật trạng thái VIP
//        $user->balance -= $vipPackage->price;
//        $user->is_vip = true; // Kích hoạt trạng thái VIP cho người dùng
//        $user->save();
//
//        // Tính ngày bắt đầu và ngày kết thúc của gói VIP
//        $startDate = Carbon::now();
//        $endDate = $startDate->copy()->addDays($vipPackage->duration_days);
//
//        // Lưu thông tin giao dịch vào bảng VIPPurchase
//        VIPPurchase::create([
//            'room_id' => $room->id,
//            'user_id' => auth()->id(),
//            'vip_package_id' => $vipPackage->id,
//            'start_date' => $startDate,
//            'end_date' => $endDate,
//            'status' => 'active',
//        ]);
//
//        // Cập nhật trạng thái phòng thành VIP và gắn gói VIP
//        $room->vip_package_id = $vipPackage->id;
//        $room->status = 1; // Thay đổi trạng thái phòng thành VIP
//        $room->save();
//
//        // Lưu quyền lợi cho phòng trọ vào bảng `room_vip_benefits`
//        foreach ($benefits as $benefit) {
//            $room->vipBenefits()->create([
//                'vip_benefit_id' => $benefit->id,
//                'enabled' => true, // Kích hoạt quyền lợi
//            ]);
//        }
//
//        // Trở lại trang và thông báo thành công
//        return redirect()->back()->with('success', 'Gói VIP đã được mua và kích hoạt cho phòng!');
//    }
//    public function purchaseVIPPackage(Request $request, $roomId, $vipPackageId)
//    {
//        $room = Rooms::findOrFail($roomId);
//        $user = auth()->user();
//        $vipPackage = VIPPackage::with('benefits')->findOrFail($vipPackageId);
//        dd($vipPackage->benefits);
//        // Kiểm tra số dư của người dùng
//        if ($user->balance < $vipPackage->price) {
//            return back()->with('error', 'Số dư không đủ để mua gói VIP.');
//        }
//
//        // Trừ tiền và lưu thông tin người dùng
//        $user->balance -= $vipPackage->price;
//        $user->save();
//
//        // Cập nhật trạng thái và gán quyền lợi cho phòng
//        $room->vip_package_id = $vipPackage->id;
//        $room->status = 1;
//        $room->save();
//
//        foreach ($vipPackage->benefits as $benefit) {
//            $room->vipBenefits()->attach($benefit->id, ['enabled' => true]);
//        }
//
//        return redirect()->back()->with('success', 'Gói VIP đã được kích hoạt cho phòng!');
//    }
    public function purchaseVIPPackage(Request $request, $roomId, $vipPackageId)
    {
        $room = Rooms::findOrFail($roomId);
        $user = auth()->user();
        $vipPackage = VipPackage::findOrFail($vipPackageId);

        if ($user->balance < $vipPackage->price) {
            return back()->with('error', 'Số dư không đủ để mua gói VIP.');
        }

        // Trừ tiền và lưu thông tin
        $user->balance -= $vipPackage->price;
        $user->save();

        $startDate = Carbon::now('Asia/Ho_Chi_Minh');
        $endDate = $startDate->copy()->addDays($vipPackage->duration_days);

        VIPPurchase::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'vip_package_id' => $vipPackage->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active',
        ]);

        // Cập nhật trạng thái bài đăng và quyền lợi hiển thị
        $room->vip_package_id = $vipPackage->id;
        $room->status = 1;
        $room->save();

        return redirect()->back()->with('success', 'VIP package purchased successfully!');
    }
    public function activateVip(Request $request)
    {
        // Kiểm tra thông tin từ request
        $vipPurchase = VIPPurchase::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'vip_package_id' => $request->vip_package_id,
            'start_date' => now(),
            'end_date' => now()->addDays(30),  // Gói VIP 30 ngày
            'status' => 'active',
        ]);

        // Cập nhật trạng thái phòng
        $room = Rooms::find($request->room_id);
        if ($room) {
            $room->vip_status = 1;  // Kích hoạt trạng thái VIP
            $room->vip_package_id = $request->vip_package_id;
            $room->save();
        }

        return response()->json(['message' => 'Gói VIP đã được kích hoạt', 'data' => $vipPurchase]);

    }

    public function deactivateVip(Request $request)
    {
        $vipPurchase = VIPPurchase::where('room_id', $request->room_id)
                                  ->where('user_id', $request->user_id)
                                  ->first();

        if ($vipPurchase) {
            $vipPurchase->status = 'expired';
            $vipPurchase->save();

            // Cập nhật trạng thái VIP của phòng
            $room = $vipPurchase->room;
            if ($room) {
                $room->deactivateVip();  // Tắt VIP cho phòng
            }

            return response()->json(['message' => 'Gói VIP đã bị tắt']);
        }

        return response()->json(['message' => 'Không tìm thấy gói VIP để tắt']);
    }
    public function showNotifications()
    {
        // Lấy tất cả thông báo chưa đọc của người dùng hiện tại
        $notifications = Auth::user()->notifications; // Sử dụng phương thức notifications để lấy tất cả thông báo

        return view('admin_core.user.notifications', compact('notifications'));
    }
    public function showVIPPackages($roomId)
    {

        $room = Rooms::findOrFail($roomId);
        $currentVIPPackageId = $room->vip_package_id ?? 0;

        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        $currentVIPTier = $user->current_vip_tier ?? 0; // Giả sử bạn có cột `current_vip_tier` trong bảng `users`

//        $vipPackages = VIPPackage::all(); // Retrieve all available VIP packages
        $vipPackages = VIPPackage::where('id', '>', $currentVIPPackageId)->get();

        return view('admin.content.vip.vip-packages', compact('room', 'vipPackages'));
    }

}
