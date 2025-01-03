<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'status' => 'nullable',
            'comment' => 'required|string|max:500',
        ]);

        // Nếu người dùng đã đăng nhập, tự động gán user_id và tên
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
            $validated['name'] = Auth::user()->name;
            $validated['email'] = Auth::user()->email; // Lấy email từ user đăng nhập
            $existingReview = Review::where('user_id', Auth::id())->first();

            if ($existingReview) {
                return redirect()->back()->with('error', 'Bạn chỉ được gửi một đánh giá!');
            }
        }

        // Lưu đánh giá vào cơ sở dữ liệu
        Review::create($validated);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }
    public function getAllReview()
    {
            $reviews =Review::all();
            return view('admin_core.content.reviews.index',compact('reviews'));
    }
}
