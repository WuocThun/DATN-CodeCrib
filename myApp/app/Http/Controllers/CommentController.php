<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Rooms;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'motel_id' => 'nullable|exists:motel,id',
            'room_id' => 'nullable|exists:rooms,id',
            'content1' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Create the comment
        $comment = Comment::create([
            'user_id' => $request->user_id, // ID người dùng hiện tại
            'motel_id' => $request->motel_id,
            'room_id' => $request->room_id,
            'content' => $request->content1,
            'rating' => $request->rating,
        ]);
        // Return a response
        return redirect()->back()->with('success', 'Bình luận đã được gửi');
    }
    public function listAllComtent(Request $request)
    {
        // Lấy thông tin lọc từ request (room_id)
        $roomId = $request->get('room_id');

        // Lấy danh sách bình luận (lọc theo room_id nếu có)
        $comments = Comment::when($roomId, function ($query, $roomId) {
            return $query->where('room_id', $roomId);
        })->with('room')->get();

        // Lấy danh sách tất cả các phòng để hiển thị trong dropdown bộ lọc
        $rooms = Rooms::all();

        return view('admin_core.content.comments.index', compact('comments', 'rooms', 'roomId'));
    }

}
