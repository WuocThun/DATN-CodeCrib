<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\VIPPackage;
use App\Models\VIPPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class VIPController extends Controller
{
    public function purchaseVIPPackage(Request $request, $roomId)
    {
        $request->validate([
            'vip_package_id' => 'required|exists:vip_packages,id',
        ]);

        $room = Rooms::findOrFail($roomId);
        $user = auth()->user(); // Lấy thông tin người dùng đang đăng nhập

        $vipPackage = VIPPackage::findOrFail($request->vip_package_id);
        if ($user->balance < $vipPackage->price) {
            return back()->with('error', 'Số dư không đủ để mua gói VIP.');
        }
        $user->balance -= $vipPackage->price;
        $user->is_vip = true; // Kích hoạt trạng thái VIP cho người dùng
        $user->save();
        // Calculate start and end dates
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($vipPackage->duration_days);

        // Create a VIP purchase record
        VIPPurchase::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'vip_package_id' => $vipPackage->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active',
        ]);

        // Optionally, update the room status or visibility
        $room->vip_package_id = $vipPackage->id;
        $room->status = 1; // Set an appropriate status for boosted visibility
        $room->save();

        return redirect()->back()->with('success', 'VIP package purchased successfully!');
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
