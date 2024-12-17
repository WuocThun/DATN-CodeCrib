<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
class WhishlistController extends Controller
{
    public function addWishlist(Request $request)
    {
        $user = Auth::user();
        $roomId = $request->input('room_id');

        // Kiểm tra xem phòng đã có trong wishlist chưa
        $exists = Wishlist::where('user_id', $user->id)->where('room_id', $roomId)->exists();

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Phòng đã có trong danh sách yêu thích']);
        }

        // Thêm phòng vào wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'room_id' => $roomId,
        ]);

//        return redirect()->route('welcome')->with('success', 'Đã thêm vào danh sách yêu thích');
        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm phòng vào danh sách yêu thích!'
        ]);
    }
    public function listWish()
    {
        $user = Auth::user()->id;
        $wishlist = Wishlist::where('user_id',$user)->pluck('room_id');
        $rooms = Rooms::whereIn('id', $wishlist)->paginate(4);

        //        var_dump($room);
        return view('fe.danhsachyeuthich',compact('rooms'));
    }
    public function removeWishlist(Request $request)
    {
        $user = Auth::user();
        $roomId = $request->input('room_id');

        Wishlist::where('user_id', $user->id)->where('room_id', $roomId)->delete();

        return response()->json(['status' => 'success', 'message' => 'Đã xóa khỏi danh sách yêu thích']);
    }

}
