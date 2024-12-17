<?php
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VnpayController extends Controller
{

    public function vnpayPayment(Request $request)
    {

        $data           = $request->all();
        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl  = "http://127.0.0.1:8000/";
        $vnp_TmnCode    = "BGEPINMJ";//Mã website tại VNPAY
        $vnp_HashSecret = "98UAXZEL4H0CZOLDST85B1OWX4TVXA4W"; //Chuỗi bí mật

        $vnp_TxnRef
            = "113"; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này

        $vnp_TxnRef    = uniqid(); // Tạo mã đơn hàng (mã giao dịch duy nhất)
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "CodecribShop";
        $vnp_Amount    = $data['amount']
                         * 100; // Chuyển đổi sang đơn vị VNĐ (VNPay yêu cầu nhân 100)
        $vnp_Locale    = "VN";
        $vnp_BankCode  = "NCB";
        $vnp_IpAddr    = $_SERVER['REMOTE_ADDR'];

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
            return redirect($vnp_Url);
        }
        // vui lòng tham khảo thêm tại code demo

    }




    //    public function vnpayPayment(Request $request)
    //    {
    //        // Nhận dữ liệu từ Request
    //        $data = $request->all();
    //
    //        // Cấu hình thông tin VNPay
    //        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //        $vnp_Returnurl  = route('admin.payment.mbbank.success'); // URL trả về sau thanh toán
    //        $vnp_TmnCode    = "BGEPINMJ"; // Mã website tại VNPAY
    //        $vnp_HashSecret = "98UAXZEL4H0CZOLDST85B1OWX4TVXA4W"; // Chuỗi bí mật
    //
    //            $vnp_TxnRef    = uniqid(); // Tạo mã đơn hàng (mã giao dịch duy nhất)
    //            $vnp_OrderInfo = "Thanh toán hóa đơn";
    //            $vnp_OrderType = "CodecribShop";
    //            $vnp_Amount    = $data['amount']
    //                             * 100; // Chuyển đổi sang đơn vị VNĐ (VNPay yêu cầu nhân 100)
    //            $vnp_Locale    = "VN";
    //        $vnp_BankCode  = $data['bank_code'] ??
    //                         "NCB"; // Lấy mã ngân hàng từ request
    //        $vnp_IpAddr    = $request->ip(); // Lấy địa chỉ IP của người dùng
    //
    //        // Tạo mảng dữ liệu gửi tới VNPay
    //        $inputData = [
    //            "vnp_Version"    => "2.1.0",
    //            "vnp_TmnCode"    => $vnp_TmnCode,
    //            "vnp_Amount"     => $vnp_Amount,
    //            "vnp_Command"    => "pay",
    //            "vnp_CreateDate" => now()->format('YmdHis'),
    //            "vnp_CurrCode"   => "VND",
    //            "vnp_IpAddr"     => $vnp_IpAddr,
    //            "vnp_Locale"     => $vnp_Locale,
    //            "vnp_OrderInfo"  => $vnp_OrderInfo,
    //            "vnp_OrderType"  => $vnp_OrderType,
    //            "vnp_ReturnUrl"  => $vnp_Returnurl,
    //            "vnp_TxnRef"     => $vnp_TxnRef,
    //        ];
    //
    //        // Thêm mã ngân hàng nếu có
    //        if ( ! empty($vnp_BankCode)) {
    //            $inputData['vnp_BankCode'] = $vnp_BankCode;
    //        }
    //
    //        // Sắp xếp dữ liệu theo thứ tự key
    //        ksort($inputData);
    //
    //        // Tạo chuỗi hash và query
    //        $query    = '';
    //        $hashdata = '';
    //        foreach ($inputData as $key => $value) {
    //            $hashdata .= $key . "=" . $value . '&';
    //            $query    .= urlencode($key) . "=" . urlencode($value) . '&';
    //        }
    //        $hashdata = rtrim($hashdata, '&');
    //        $query    = rtrim($query, '&');
    //
    //        // Tạo chữ ký bảo mật
    //        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    //        $vnp_Url       .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;
    //
    //        // Redirect người dùng tới VNPay
    //        return redirect($vnp_Url);
    //    }
    //    public function vnpayPayment(Request $request)
    //    {
    //        // Nhận dữ liệu từ Request
    //        $data = $request->all();
    //
    //        // Cấu hình thông tin VNPay
    //        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //        $vnp_Returnurl
    //                        = route('admin.payment.mbbank.success'); // URL trả về sau thanh toán
    //        $vnp_TmnCode    = "IX8KGNQT"; // Mã website tại VNPAY
    //        $vnp_HashSecret = "NIECPGZUTBOPHTKKWZVJWTSLTKFLUKUS"; // Chuỗi bí mật
    //
    //        // Thông tin giao dịch
    //        $vnp_TxnRef    = uniqid(); // Mã đơn hàng (duy nhất)
    //        $vnp_OrderInfo = $data['order_desc'] ??
    //                         "Thanh toán hóa đơn"; // Mô tả giao dịch
    //        $vnp_OrderType = $data['order_type'] ?? "billpayment"; // Loại giao dịch
    //        $vnp_Amount    = ($data['amount'] ?? 0)
    //                         * 100; // Số tiền (nhân 100 theo yêu cầu VNPay)
    //        $vnp_Locale    = $data['language'] ?? "vn"; // Ngôn ngữ giao diện
    //        $vnp_BankCode  = $data['bank_code'] ?? ""; // Mã ngân hàng (nếu có)
    //        $vnp_IpAddr    = $request->ip(); // Lấy địa chỉ IP của người dùng
    //
    //        // Tạo mảng dữ liệu gửi tới VNPay
    //        $inputData = [
    //            "vnp_Version"    => "2.1.0",
    //            "vnp_TmnCode"    => $vnp_TmnCode,
    //            "vnp_Amount"     => $vnp_Amount,
    //            "vnp_Command"    => "pay",
    //            "vnp_CreateDate" => now()->format('YmdHis'),
    //            "vnp_CurrCode"   => "VND",
    //            "vnp_IpAddr"     => $vnp_IpAddr,
    //            "vnp_Locale"     => $vnp_Locale,
    //            "vnp_OrderInfo"  => $vnp_OrderInfo,
    //            "vnp_OrderType"  => $vnp_OrderType,
    //            "vnp_ReturnUrl"  => $vnp_Returnurl,
    //            "vnp_TxnRef"     => $vnp_TxnRef,
    //        ];
    //
    //        // Thêm mã ngân hàng nếu có
    //        if ( ! empty($vnp_BankCode)) {
    //            $inputData['vnp_BankCode'] = $vnp_BankCode;
    //        }
    //
    //        // Sắp xếp dữ liệu theo thứ tự key
    //        ksort($inputData);
    //
    //        // Tạo chuỗi hash và query
    //        $hashdata = urldecode(http_build_query($inputData));
    //        $query    = http_build_query($inputData);
    //
    //        // Tạo chữ ký bảo mật
    //        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    //        $vnp_Url       .= "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;
    //
    //        // Redirect người dùng tới VNPay
    //        return redirect($vnp_Url);
    //    }

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

    //    public function vnpayReturn(Request $request)
    //    {
    //        // Xử lý logic sau khi người dùng thanh toán xong tại VNPay và được trả về
    //        $inputData      = $request->all();
    //        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
    //
    //        $vnp_HashSecret = "98UAXZEL4H0CZOLDST85B1OWX4TVXA4W"; // Chuỗi bí mật
    //        $hashdata       = '';
    //
    //        foreach ($inputData as $key => $value) {
    //            if ($key != 'vnp_SecureHash' && $key != 'vnp_SecureHashType') {
    //                $hashdata .= $key . '=' . $value . '&';
    //            }
    //        }
    //        $hashdata = rtrim($hashdata, '&');
    //
    //        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    //
    //        // Kiểm tra tính hợp lệ của chữ ký
    //        if ($secureHash === $vnp_SecureHash) {
    //            if ($inputData['vnp_ResponseCode'] == '00') {
    //                // Thanh toán thành công
    //                return view('admin.content.payment.success',
    //                    ['data' => $inputData]);
    //            } else {
    //                // Thanh toán thất bại
    //                return view('admin.content.payment.cancel',
    //                    ['data' => $inputData]);
    //            }
    //        } else {
    //            // Chữ ký không hợp lệ
    //            return view('admin.content.payment.cancel');
    //        }
    //    }

}
