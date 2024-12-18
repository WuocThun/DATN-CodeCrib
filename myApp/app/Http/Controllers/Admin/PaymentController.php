<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Motel;
use App\Models\User;
use Illuminate\Http\Request;
use PayOS\PayOS;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    private $payOSClientId;
    private $payOSApiKey;
    private $payOSChecksumKey;

    public function indexPayment()
    {
        return view('admin_core.content.payments.index');
    }

    public function userPayhouseRent(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $user    = auth()->user();
        if ($user->balance >= $request->amount) {
            // Trừ số dư của người dùng
            $user->balance -= $request->amount;
            $user->save(); // Lưu số dư mới
            $landlord
                               = User::findOrFail($invoice->user_id); // Lấy thông tin chủ trọ
            $landlord->balance += $request->amount;
            $landlord->save(); // Lưu số dư mới cho chủ trọ
            $invoice->status = 'paid';
            $invoice->save(); // Lưu trạng thái hóa đơn
            // Thông báo thành công và chuyển hướng
            return redirect()->back()
                             ->with('success', 'Hóa đơn đã được thanh toán!');
        } else {
            // Nếu số dư của người dùng không đủ
            return back()->with('error',
                'Số dư của bạn không đủ để thanh toán hóa đơn.');
        }
    }

    public function createPaymentLink(Request $request)
    {
        $data                         = $request->all();
        $orderCode                    = intval(substr(strval(microtime(true)
                                                             * 10000), -6));
        $getAmount                    = intval($data['amount']);
        $getUserId                    = auth()->id();
        $getUserPhone                 = substr(auth()->user()->phone_number,
            -3);
        $description                  = "Crib " . $getUserId . " "
                                        . $getUserPhone;
        $orderPayment                 = new OrderPayment();
        $orderPayment->amount         = $getAmount;
        $orderPayment->payment_status = '0';
        $orderPayment->description    = $description;
        $orderPayment->order_code     = $orderCode;
        $orderPayment->user_id        = $getUserId;
        $orderPayment->save();
        $cancelUrl = route('admin.payment.mbbank.cancel');
        //                $returnUrl = route('admin.payment.mbbank.success');
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        $data        = [
            "orderCode"   => $orderCode,
            "amount"      => $getAmount,
            "description" => $description,
            "returnUrl"   => $YOUR_DOMAIN
                             . "/admin/payment/mbbank/success?amount={$getAmount}&payment_status=1&order_code={$orderCode}",
            "cancelUrl"   => $YOUR_DOMAIN
                             . "/admin/payment/mbbank/cancel?order_code={$orderCode}",
            //            "cancelUrl"   => $cancelUrl,
        ];
        error_log($data['orderCode']);

        try {
            $response = $this->payOS->createPaymentLink($data);

            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function createPaymentLinkInvionce(Request $request, $id)
    {
        $data          = $request->all();
        $orderCode     = intval(substr(strval(microtime(true)
                                              * 10000), -6));
        $getAmount     = intval($data['amount']);
        $passwordMotel = $data['password_motel'];

        $description                  = "CK: " . $passwordMotel;
        $orderPayment                 = new OrderPayment();
        $orderPayment->amount         = $getAmount;
        $orderPayment->payment_status = '0';
        $orderPayment->user_id        = auth()->id();
        $orderPayment->order_code     = $orderCode;
        $orderPayment->description    = $description;
        $orderPayment->save();
        $cancelUrl = route('admin.payment.mbbank.cancel');
        //                $returnUrl = route('admin.payment.mbbank.success');
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        $data        = [
            "orderCode"   => $orderCode,
            "amount"      => $getAmount,
            "description" => $description,
            "returnUrl"   => $YOUR_DOMAIN
                             . "/admin/payment/invoice/success?amount={$getAmount}&payment_status=1&order_code={$orderCode}?password={$passwordMotel}",
            "cancelUrl"   => $YOUR_DOMAIN
                             . "/admin/payment/mbbank/cancel?order_code={$orderCode}",
            //            "cancelUrl"   => $cancelUrl,
        ];
        error_log($data['orderCode']);

        try {
            $response = $this->payOS->createPaymentLink($data);

            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function successPaymentInvoice(Request $request)
    {
        $payment_status   = intval($request->get('payment_status'));
        $order_code       = $request->get('orderCode');
        $orderPayment     = OrderPayment::where('order_code',
            $order_code)->first();
        $getPassword      = $request->get('password');
        $getMotel         = Motel::where('password', $getPassword)->first();
        $motelId          = $getMotel->id;
        $getInvoice       = Invoice::where('motel_id', $motelId)->first();
        $getUserIdInvoice = $getInvoice->user_id;
        $getInvoice->update(['status' => 'paid']);
        $orderPayment->payment_status = $payment_status;
        //        dd($orderPayment);
        $orderPayment->save();
        $amount  = intval($request->get('amount'));
        $getUser = User::findOrFail($getUserIdInvoice);
        // Update the user's balance
        $getUser->balance += $amount; // Assuming you have a 'balance' field in your users table
        $getUser->save();

        return view('admin.content.payment.success');
    }

    public function handlePayOSWebhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                "error"   => 1,
                "message" => "Invalid JSON payload",
            ], 400);
        }

        // Handle webhook test
        if (in_array($body["data"]["description"],
            ["Ma giao dich thu nghiem", "VQRIO123"])
        ) {
            return response()->json([
                "error"   => 0,
                "message" => "Ok",
                "data"    => $body["data"],
            ]);
        }

        try {
            $this->payOS->verifyPaymentWebhookData($body);
        } catch (\Exception $e) {
            return response()->json([
                "error"   => 1,
                "message" => "Invalid webhook data",
                "details" => $e->getMessage(),
            ], 400);
        }

        // Process webhook data
        // ...

        return response()->json([
            "error"   => 0,
            "message" => "Ok",
            "data"    => $body["data"],
        ]);
    }

    public function vnpay()
    {
        return view('admin_core.content.payments.checkout_vnPay');
    }

    public function createOrder(Request $request)
    {
        $body              = $request->input();
        $body["amount"]    = intval($body["amount"]);
        $body["orderCode"] = intval(substr(strval(microtime(true) * 100000),
            -6));

        try {
            $response = $this->payOS->createPaymentLink($body);

            return response()->json([
                "error"   => 0,
                "message" => "Success",
                "data"    => $response["checkoutUrl"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function getPaymentLinkInfoOfOrder(string $id)
    {
        try {
            $response = $this->payOS->getPaymentLinkInformation($id);

            return response()->json([
                "error"   => 0,
                "message" => "Success",
                "data"    => $response["data"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function cancelPaymentLinkOfOrder(Request $request, string $id)
    {
        $body       = json_decode($request->getContent(), true);
        $cancelBody = is_array($body) && $body["cancellationReason"] ? $body
            : null;

        try {
            $response = $this->payOS->cancelPaymentLink($id, $cancelBody);

            return response()->json([
                "error"   => 0,
                "message" => "Success",
                "data"    => $response["data"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function addAmountForUser() {}

    public function successPayment(Request $request)
    {
        $payment_status               = intval($request->get('payment_status'));
        $order_code                   = $request->get('orderCode');
        $orderPayment                 = OrderPayment::where('order_code',
            $order_code)->first();
        $orderPayment->payment_status = $payment_status;
        //        dd($orderPayment);
        $orderPayment->save();
        $amount = intval($request->get('amount'));
        $user   = auth()->user();
        // Update the user's balance
        $user->balance += $amount; // Assuming you have a 'balance' field in your users table
        $user->save();
        return view('admin.content.payment.success');
    }

    public function vnpaySuccess(Request $request)
    {
        $payment_status               = intval($request->get('payment_status'));
        $order_code                   = $request->get('vnp_TransactionNo');
        $orderPayment                 = OrderPayment::where('order_code',
            $order_code)->first();
        $orderPayment->payment_status = $payment_status;
        //        dd($orderPayment);
        $orderPayment->save();
        $amount = intval($request->get('vnp_Amount'));
        $user   = auth()->user();

        // Update the user's balance
        $user->balance += $amount; // Assuming you have a 'balance' field in your users table
        $user->save();

        return view('admin.content.payment.success');

    }

    public function cancelPayment(Request $request)
    {
        $order_code                   = $request->get('order_code');
        $orderPayment                 = OrderPayment::where('order_code',
            $order_code)->first();
        $orderPayment->payment_status = '2';
        $orderPayment->save();

        return view('admin.content.payment.cancel');

    }

    public function index(Request $request)
    {
        return view('admin_core.content.payments.checkout');
    }
    //    public function report(Request $request)
    //    {
    //        // Lấy dữ liệu từ bảng order_payment
    //        $userId = $request->get('user_id');
    //        $date = $request->get('date');
    //        $month = $request->get('month');
    //
    //        // Truy vấn danh sách user đã nạp tiền
    //        $users = DB::table('order_payment')
    //                   ->join('users', 'order_payment.user_id', '=', 'users.id')
    //                   ->select('users.id', 'users.name')
    //                   ->groupBy('users.id', 'users.name')
    //                   ->get();
    //
    //        // Truy vấn dữ liệu tổng hợp
    //        $query = DB::table('order_payment')
    //                   ->join('users', 'order_payment.user_id', '=', 'users.id')
    //                   ->select(
    //                       'users.name',
    //                       'users.id as user_id',
    //                       DB::raw('SUM(order_payment.amount) as total_amount'),
    //                       DB::raw('COUNT(order_payment.id) as total_orders'),
    //                       DB::raw('DATE(order_payment.created_at) as created_date'),
    //                       DB::raw('MONTH(order_payment.created_at) as created_month')
    //                   )
    //                   ->groupBy('users.id', 'users.name', 'created_date', 'created_month');
    //
    //        // Áp dụng bộ lọc
    //        if ($userId) {
    //            $query->where('users.id', $userId);
    //        }
    //        if ($date) {
    //            $query->whereDate('order_payment.created_at', $date);
    //        }
    //        if ($month) {
    //            $query->whereMonth('order_payment.created_at', $month);
    //        }
    //
    //        $data = $query->get();
    //
    //        // Tìm người nạp nhiều nhất
    //        $topUser = $data->sortByDesc('total_amount')->first();
    //        $payments = OrderPayment::all();
    //
    //        // Tính toán thống kê
    //        $totalAmount = $payments->sum('amount');
    //        $paymentStatusCounts = $payments->groupBy('payment_status')->map->count();
    //
    //        return view('admin_core.content.payments.report', compact('data', 'users', 'topUser','totalAmount', 'paymentStatusCounts'));
    //    }
    public function report(Request $request)
    {
        // Lấy thông tin từ request
        $userId = $request->get('user_id');
        $date   = $request->get('date');
        $month  = $request->get('month');

        // Lấy danh sách người dùng đã có giao dịch "đã thanh toán"
        $users = DB::table('order_payment')
                   ->join('users', 'order_payment.user_id', '=', 'users.id')
            //                   ->where('order_payment.payment_status', 1) // Chỉ lấy giao dịch đã thanh toán
                   ->select('users.id', 'users.name')
                   ->groupBy('users.id', 'users.name')
                   ->get();

        // Truy vấn dữ liệu tổng hợp
        $query = DB::table('order_payment')
                   ->join('users', 'order_payment.user_id', '=', 'users.id')
                   ->where('order_payment.payment_status',
                       1) // Chỉ tính giao dịch đã thanh toán
                   ->select(
                'users.name',
                'users.id as user_id',
                DB::raw('SUM(order_payment.amount) as total_amount'),
                DB::raw('COUNT(order_payment.id) as total_orders'),
                DB::raw('DATE(order_payment.created_at) as created_date'),
                DB::raw('MONTH(order_payment.created_at) as created_month')
            )
                   ->groupBy('users.id', 'users.name', 'created_date',
                       'created_month');

        // Áp dụng bộ lọc
        if ($userId) {
            $query->where('users.id', $userId);
        }
        if ($date) {
            $query->whereDate('order_payment.created_at', $date);
        }
        if ($month) {
            $query->whereMonth('order_payment.created_at', $month);
        }
        $statusCounts = DB::table('order_payment')
                          ->select(
                              DB::raw('SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as pending'),
                              DB::raw('SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as completed'),
                              DB::raw('SUM(CASE WHEN payment_status = 2 THEN 1 ELSE 0 END) as canceled')
                          )
                          ->first();

        // Chuẩn bị dữ liệu cho biểu đồ Pie Chart
        $statusData = [
            ['label' => 'Chưa thanh toán', 'count' => $statusCounts->pending],
            ['label' => 'Đã thanh toán', 'count' => $statusCounts->completed],
            ['label' => 'Hủy', 'count' => $statusCounts->canceled],
        ];

        $payments = DB::table('order_payment')
                      ->select(
                          DB::raw('DATE(created_at) as date'),
                          DB::raw('SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as pending'),
                          DB::raw('SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as completed'),
                          DB::raw('SUM(CASE WHEN payment_status = 2 THEN 1 ELSE 0 END) as canceled')
                      )
                      ->groupBy('date')
                      ->orderBy('date', 'ASC')
                      ->get();

        // Chuyển đổi dữ liệu để phù hợp với Chart.js
        $labels        = $payments->pluck('date');
        $pendingData   = $payments->pluck('pending');
        $completedData = $payments->pluck('completed');
        $canceledData  = $payments->pluck('canceled');
        $data          = $query->get();

        // Tìm người nạp nhiều nhất trong danh sách đã thanh toán
        $topUser = $data->sortByDesc('total_amount')->first();

        // Lấy tất cả các giao dịch đã thanh toán
        $payments = OrderPayment::all();

        // Tính toán thống kê
        $totalAmount = $payments->sum('amount'); // Tổng số tiền đã thanh toán
        $paymentStatusCounts
                     = $payments->groupBy('payment_status')->map->count(); // Đếm trạng thái

        return view('admin_core.content.payments.report',
            compact('data', 'users', 'topUser', 'totalAmount',
                'paymentStatusCounts', 'labels', 'pendingData', 'completedData',
                'canceledData', 'statusData'));
    }

    public function getHistoryPayment()
    {
        $getUserId     = auth()->id();
        $orderPayment  = OrderPayment::where('user_id', $getUserId)
                                     ->orderBy('id', 'desc')->paginate(7);
        $getAllPayment = OrderPayment::where('user_id', $getUserId)->get();

        return view('admin_core.content.payments.history_payment',
            compact('orderPayment', 'getAllPayment'));
    }

}
