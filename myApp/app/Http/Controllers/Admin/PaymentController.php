<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayOS\PayOS;
use App\Models\OrderPayment;
class PaymentController extends Controller
{

    private $payOSClientId;
    private $payOSApiKey;
    private $payOSChecksumKey;
    //    public function __construct()
    //    {
    //        $this->payOSClientId =env('PAYOS_CLIENT_ID');
    //        $this->payOSApiKey =env('PAYOS_API_KEY');
    //        $this->payOSChecksumKey= env('PAYOS_CHECKSUM_KEY');
    //    }
    public function createPaymentLink(Request $request)
    {
        $data         = $request->all();
        $orderCode    = intval(substr(strval(microtime(true) * 10000), -6));
        $getAmount    = intval($data['amount']);
        $getUserId    = auth()->id();
        $getUserPhone = substr(auth()->user()->phone_number, -3);
        $description = "Crib " . $getUserId . " " . $getUserPhone;
        $orderPayment = new OrderPayment();
        $orderPayment->amount = $getAmount;
        $orderPayment->payment_status = '0';
        $orderPayment->description = $description;
        $orderPayment->order_code = $orderCode;
        $orderPayment->user_id = $getUserId;
        $orderPayment->save();
        $cancelUrl    = route('admin.payment.mbbank.cancel');
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
        $payment_status = intval($request->get('payment_status'));
        $order_code = $request->get('orderCode');
        $orderPayment = OrderPayment::where('order_code',$order_code)->first();
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

    public function cancelPayment(Request $request)
    {
        $order_code = $request->get('order_code');
        $orderPayment = OrderPayment::where('order_code',$order_code)->first();
        $orderPayment->payment_status = '2';
        $orderPayment->save();
        return view('admin.content.payment.cancel');

    }

    public function index(Request $request)
    {
//        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
//        echo $YOUR_DOMAIN;

        return view('admin.content.payment.checkout');
    }

   public function getHistoryPayment()
   {
       $getUserId = auth()->id();
       $orderPayment = OrderPayment::where('user_id',$getUserId)->get();
       return view('admin.content.payment.history', compact('orderPayment'));
   }

}
