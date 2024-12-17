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
    public function getVipRooms()
    {
        $vipRooms = VipPurchase::with(['room', 'vipPackage'])
                               ->where('status', 'active')
                               ->orderBy('start_date', 'DESC')
                               ->get();

        return view('admin_core.content.vip.index', compact('vipRooms'));
    }

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
    public function deleteVip($id)
    {
        try {
            // Tìm và xoá gói VIP đã mua
            $vipPurchase = VipPurchase::findOrFail($id);
            $vipPurchase->delete();

            // Chuyển hướng với thông báo thành công
            return redirect()->back()->with('success', 'Gói VIP đã được xoá thành công.');
        } catch (\Exception $e) {
            // Xử lý lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xoá gói VIP: ' . $e->getMessage());
        }
    }
    public function deactivate($id)
    {
        try {
            // Tìm gói VIP theo ID
            $vipPurchase = VipPurchase::findOrFail($id);

            // Cập nhật trạng thái của gói VIP
            $vipPurchase->update(['status' => 'canceled']);

            // Chuyển hướng với thông báo thành công
            return redirect()->back()->with('success', 'Gói VIP đã được tắt thành công.');
        } catch (\Exception $e) {
            // Xử lý lỗi và thông báo
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
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
