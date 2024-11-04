<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */

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
}
