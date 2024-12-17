<?php

namespace App\Http\Controllers;

use App\Models\Motel;
use App\Models\RoomRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RoomRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = Motel::where('status', 1);

        // Nếu có giá trị password, thêm điều kiện tìm kiếm
        if ($request->has('password') && $request->password != '') {
            $query->where('password', $request->password);
        }
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('full_address', 'LIKE', "%{$keyword}%")
                  ->orWhere('province', 'LIKE', "%{$keyword}%")
                  ->orWhere('district', 'LIKE', "%{$keyword}%");
            });
        }

        // Phân trang danh sách phòng trọ
        $motels = $query->orderBy('id', 'DESC')->paginate(7);

        return view('fe.phongtrocontrong', compact('motels'));
    }

    public function inviteUser(Request $request)
    {
        $request->validate([
            'motel_id' => 'required|exists:motel,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        // Kiểm tra xem user đã ở trong phòng chưa
        if ($user->motel_id) {
            return back()->with('error', 'Người dùng này đã ở trong một phòng trọ khác.');
        }

        // Kiểm tra nếu user đã được mời trước đó
        $existingRequest = RoomRequest::where('user_id', $request->user_id)
                                      ->where('motel_id', $request->motel_id)
                                      ->where('status', 'pending')
                                      ->first();

        if ($existingRequest) {
            return back()->with('error', 'Người dùng đã được mời trước đó.');
        }

        // Tạo yêu cầu mới
        RoomRequest::create([
            'user_id' => $request->user_id,
            'motel_id' => $request->motel_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Lời mời đã được gửi thành công.');
    }

    public function searchUser(Request $request)
    {
        $request->validate([
            'rand_code_user' => 'required|string',
        ]);

        // Tìm kiếm user theo rand_code_user
        $user = User::where('rand_code_user', $request->rand_code_user)->first();

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy người dùng.'], 404);
        }
        if (!$user->hasRole('viewer')) {
            return response()->json(['error' => 'Người dùng không phải là người kiếm trọ.'], 403);
        }
        return response()->json(['user' => $user]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'motel_id' => 'required|exists:motel,id',
        ]);
        if (auth()->user()->motel_id) {
            return back()->with('error', 'Bạn đã ở trong phòng trọ và không thể gửi yêu cầu ở ghép.');
        }
        // Kiểm tra nếu người dùng đã gửi yêu cầu
        $existingRequest = RoomRequest::where('user_id', auth()->id())
                                      ->where('motel_id', $request->motel_id)
                                      ->where('status', 'pending')
                                      ->first();

        if ($existingRequest) {
            return back()->with('error', 'Bạn đã gửi yêu cầu tham gia phòng này trước đó.');
        }

        // Tạo yêu cầu mới
        RoomRequest::create([
            'user_id' => auth()->id(),
            'motel_id' => $request->motel_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Yêu cầu tham gia phòng đã được gửi.');
    }
    public function accept($id)
    {
        $request = RoomRequest::findOrFail($id);

        // Kiểm tra nếu chủ trọ là người quản lý phòng
        if ($request->motel->user_id !== auth()->id()) {
            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
        }

        $motel = $request->motel;

        // Đếm số lượng thành viên hiện tại trong phòng
        $currentMembers = User::where('motel_id', $motel->id)->count();

        // Kiểm tra nếu số thành viên đã đạt giới hạn
        if ($currentMembers >= $motel->total_member) {
            return back()->with('error', 'Phòng đã đạt số lượng thành viên tối đa.');
        }

        // Chấp nhận yêu cầu và cập nhật trạng thái
        $request->status = 'accepted';

        // Cập nhật motel_id vào bảng users
        $user = $request->user; // Lấy thông tin người dùng từ yêu cầu
        $user->motel_id = $motel->id; // Gán motel_id cho người dùng
        $user->save();

        $request->save();

        return back()->with('success', 'Yêu cầu đã được chấp nhận và người dùng đã được thêm vào phòng.');
    }

//    public function accept($id)
//    {
//        $request = RoomRequest::findOrFail($id);
//
//        // Kiểm tra nếu chủ trọ là người quản lý phòng
//        if ($request->motel->user_id !== auth()->id()) {
//            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
//        }
//
//        // Chấp nhận yêu cầu và cập nhật trạng thái
//        $request->status = 'accepted'; // Sửa trạng thái
////        $request->save();
//        // Cập nhật motel_id vào bảng users
//        $user = $request->user; // Lấy thông tin người dùng từ yêu cầu
//        $user->motel_id = $request->motel->id; // Gán motel_id cho người dùng
//        $user->save();
//        $request->save();
//
//
//        return back()->with('success', 'Yêu cầu đã được chấp nhận và người dùng đã được thêm vào phòng.');
//    }


    public function reject($id)
    {
        $request = RoomRequest::findOrFail($id);

        // Kiểm tra quyền
        if ($request->motel->user_id !== auth()->id()) {
            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
        }

        // Từ chối yêu cầu
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Yêu cầu đã bị từ chối.');
    }

}
