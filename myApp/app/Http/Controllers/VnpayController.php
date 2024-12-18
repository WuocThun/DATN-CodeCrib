<?php
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderPayment;

class VnpayController extends Controller
{

    public function vnpayPayment(Request $request)
    {
        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

        $data           = $request->all();
        $vnp_TmnCode    = "BGEPINMJ";//Mã website tại VNPAY
        $vnp_HashSecret = "98UAXZEL4H0CZOLDST85B1OWX4TVXA4W"; //Chuỗi bí mật
        $vnp_TxnRef    = uniqid(); // Tạo mã đơn hàng (mã giao dịch duy nhất)
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "CodecribShop";
        $vnp_Amount    = $data['amount']
                         * 100; // Chuyển đổi sang đơn vị VNĐ (VNPay yêu cầu nhân 100)
        $vnp_Locale    = "VN";
        $vnp_BankCode  = "NCB";
        $vnp_IpAddr    = $_SERVER['REMOTE_ADDR'];
        $des = $vnp_BankCode . auth()->id() . $vnp_TxnRef;
        $vnp_Returnurl  = "http://127.0.0.1:8000/admin/payment/vnpay/status?des={$des}";

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,

        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query    = "";
        $i        = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i        = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url       .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = [
            'code'    => '00'
            ,
            'message' => 'success'
            ,
            'data'    => $vnp_Url,
        ];
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            $des = $vnp_BankCode . auth()->id() . $vnp_TxnRef;
            $orderPayment                 = new OrderPayment();
            $orderPayment->amount         = $data['amount'];
            $orderPayment->payment_status = '0';
            $orderPayment->description    = $des;
            $orderPayment->order_code     = $des;
            $orderPayment->user_id        = auth()->id();
//            dd($vnp_BankCode);
            $orderPayment->save();
            return redirect($vnp_Url);
        }
    }

    public function vnpayReturn(Request $request)
    {
        // Lấy dữ liệu trả về từ VNPay
        $inputData      = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';

        $vnp_HashSecret = "98UAXZEL4H0CZOLDST85B1OWX4TVXA4W"; // Chuỗi bí mật
        $hashdata       = '';

        foreach ($inputData as $key => $value) {
            if ($key != 'vnp_SecureHash' && $key != 'vnp_SecureHashType') {
                $hashdata .= $key . '=' . $value . '&';
            }
        }
        $hashdata = rtrim($hashdata, '&');

        // Kiểm tra tính hợp lệ của chữ ký
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công
                return response()->json([
                    'code'    => 200,
                    'message' => 'Giao dịch thành công',
                    'data'    => $inputData,
                ]);
            } else {
                // Thanh toán thất bại
                return response()->json([
                    'code'    => 400,
                    'message' => 'Giao dịch không thành công',
                    'data'    => $inputData,
                ]);
            }
        } else {
            // Chữ ký không hợp lệ
            return response()->json([
                'code'    => 401,
                'message' => 'Chữ ký không hợp lệ',
            ]);
        }
    }

    public function successPayment(Request $request)
    {
        $order_code                   = $request->get('des');
        $orderPayment                 = OrderPayment::where('order_code', $order_code)->first();
        $orderPayment->payment_status = 1 ;
        $orderPayment->save();

        $amount = intval($request->get('vnp_Amount')) / 100;
        $user   = auth()->user();
        // Update the user's balance
        $user->balance += $amount;
        // Assuming you have a 'balance' field in your users table
        $user->save();

        return view('admin.content.payment.success');
    }

}
