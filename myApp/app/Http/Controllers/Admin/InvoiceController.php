<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motel;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{


//    public function createInvoice(Request $request)
//    {
//        // Lấy dữ liệu từ form
//        $validated = $request->validate([
//            'motel_id'     => 'required|exists:motel,id',
//            'new_electric' => 'required|integer',
//            'old_electric' => 'required|integer',
//            'new_water'    => 'required|integer',
//            'old_water'    => 'required|integer',
//            'money_water'    => 'required|integer',
//            'money_electric'    => 'required|integer',
//            'money'    => 'required|integer',
//            'money_another'    => 'required|integer',
//        ]);
//
//        // Tính tiền điện, nước
//        $electric_fee = ($validated['new_electric']
//                         - $validated['old_electric'])
//                        * $validated['money_electric']; // Ví dụ: 3500 VNĐ/kWh
//        $water_fee    = ($validated['new_water'] - $validated['old_water'])
//                        * $validated['money_water']; // Ví dụ: 5000 VNĐ/m3
//        $total_amount = $electric_fee + $water_fee +  $validated['money'];
//
//        // Tạo hóa đơn
//        $invoice = Invoice::create([
//            'user_id' => \auth()->id(),
//            'motel_id'     => $validated['motel_id'],
//            'new_electric' => $validated['new_electric'],
//            'old_electric' => $validated['old_electric'],
//            'new_water'    => $validated['new_water'],
//            'old_water'    => $validated['old_water'],
//            'money_water'    => $validated['money_water'],
//            'all_money'    => $total_amount,
//            'money_electric'    => $validated['money_electric'],
//            'money'    => $validated['money'],
//            'money_another'    => $validated['money_another'],
//            'electric_fee' => $electric_fee,
//            'water_fee'    => $water_fee,
//            'total_amount' => $total_amount,
//        ]);
//
//        // Chuyển hướng đến trang thanh toán
//        return redirect()->route('admin.invoices.pay', ['id' => $invoice->id]);
//    }
    public function createInvoice(Request $request)
    {
        try {
            // Lấy dữ liệu từ form và validate
            $validated = $request->validate([
                'motel_id'       => 'required|exists:motel,id',
                'new_electric'   => 'required|integer',
                'old_electric'   => 'required|integer',
                'new_water'      => 'required|integer',
                'old_water'      => 'required|integer',
                'money_water'    => 'required|integer',
                'money_electric' => 'required|integer',
                'money'          => 'required|integer',
                'money_another'  => 'integer',
                'money_wifi'  => 'integer',
            ]);

            // Kiểm tra xem phòng trọ này đã có hóa đơn chưa
            $existingInvoice = Invoice::where('motel_id',
                $validated['motel_id'])->first();
            if ($existingInvoice) {
                return redirect()->back()->with('error',
                    'Phòng trọ này đã có hóa đơn, không thể tạo thêm!');
            }

            // Tính tiền điện, nước
            $electric_fee = ($validated['new_electric']
                             - $validated['old_electric'])
                            * $validated['money_electric'];
            $water_fee    = ($validated['new_water'] - $validated['old_water'])
                            * $validated['money_water'];
            $total_amount = $electric_fee + $water_fee + $validated['money'] + $validated['money_another'];

            // Tạo hóa đơn
            $invoice = Invoice::create([
                'user_id'        => \auth()->id(),
                'motel_id'       => $validated['motel_id'],
                'new_electric'   => $validated['new_electric'],
                'old_electric'   => $validated['old_electric'],
                'new_water'      => $validated['new_water'],
                'old_water'      => $validated['old_water'],
                'money_water'    => $validated['money_water'],
                'money_electric' => $validated['money_electric'],
                'money'          => $validated['money'],
                'all_money'      => $total_amount,
                'money_another'  => $validated['money_another'],
                'electric_fee'   => $electric_fee,
                'water_fee'      => $water_fee,
                'total_amount'   => $total_amount,
            ]);

            // Chuyển hướng đến trang thanh toán
            return redirect()
                ->route('admin.invoices.pay', ['id' => $invoice->id])
                ->with('success', 'Hóa đơn đã được tạo thành công!');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error',
                'Hóa đơn cho phòng trọ này đã tồn tại!');
        }
    }
//    public function motelReport(Request $request)
//    {
//        // Lấy ID của người dùng đang đăng nhập
//        $getUserId = Auth::id();
//        $allMotels  = Motel::where('user_id', $getUserId)->get();
//        // Lấy thông tin các hóa đơn đã thanh toán của người dùng
//        $invoices = Invoice::where([
//            ['user_id', '=', $getUserId],
//            ['status', '=', 'paid'],
//        ])->get();
//
//        // Tính tổng tiền phải trả cho người dùng (bao gồm các chi phí ngoài tiền điện, nước)
//        $totalAmount = $invoices->sum(function ($invoice) {
//            return $invoice->all_money ;
//        });
//
//        // Tính tổng tiền điện (sự chênh lệch giữa điện cũ và điện mới nhân với mức phí)
//        $totalElectric = $invoices->sum(function ($invoice) {
//            return  $invoice->electric_fee;
//        });
//
//        // Tính tổng tiền nước (sự chênh lệch giữa nước cũ và nước mới nhân với mức phí)
//        $totalWater = $invoices->sum(function ($invoice) {
//            return  $invoice->water_fee;
//        });
//
//        // Lấy thông tin về các motel của người dùng
//        $motels = Motel::where('user_id', $getUserId)->get();
//
//        // Tính toán tổng số tiền liên quan đến các motel
//        $totalMotelIncome = $motels->sum('money'); // Tổng tiền phòng cho các motel
//        $totalElectricIncome = $motels->sum('money_electric'); // Tổng tiền điện
//        $totalWaterIncome = $motels->sum('money_water'); // Tổng tiền nước
//        $totalWifiIncome = $motels->sum('money_wifi'); // Tổng tiền wifi
//        $totalOtherIncome = $motels->sum('money_another'); // Tổng các khoản phí khác
//
//        // Truyền dữ liệu vào view
//        return view('admin_core.content.motel.report', [
//            'totalAmount' => $totalAmount,
//            'totalElectric' => $totalElectric,
//            'totalWater' => $totalWater,
//            'invoices' => $invoices,
//            'allMotels' =>$allMotels,
//            'motels' => $motels,
//            'totalMotelIncome' => $totalMotelIncome,
//            'totalElectricIncome' => $totalElectricIncome,
//            'totalWaterIncome' => $totalWaterIncome,
//            'totalWifiIncome' => $totalWifiIncome,
//            'totalOtherIncome' => $totalOtherIncome,
//        ]);
//
//    }
    public function motelReport(Request $request)
    {
        // Lấy ID của người dùng đang đăng nhập
        $getUserId = Auth::id();
        $allMotels = Motel::where('user_id', $getUserId)->get();

        // Lấy thông tin từ bộ lọc
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $motelId = $request->input('motel_id');

        // Lọc hóa đơn theo điều kiện
        $invoicesQuery = Invoice::where([
            ['user_id', '=', $getUserId],
            ['status', '=', 'paid'],
        ]);

        if ($startDate) {
            $invoicesQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $invoicesQuery->whereDate('created_at', '<=', $endDate);
        }

        if ($motelId) {
            $invoicesQuery->where('motel_id', $motelId);
        }

        $invoices = $invoicesQuery->get();

        // Tổng hợp dữ liệu cần thiết
        $totalAmount = $invoices->sum('all_money');
        $totalElectric = $invoices->sum('electric_fee');
        $totalWater = $invoices->sum('water_fee');

        $motels = Motel::where('user_id', $getUserId)->get();
        $totalMotelIncome = $motels->sum('money');
        $totalElectricIncome = $motels->sum('money_electric');
        $totalWaterIncome = $motels->sum('money_water');
        $totalWifiIncome = $motels->sum('money_wifi');
        $totalOtherIncome = $motels->sum('money_another');

        // Truyền dữ liệu vào view
        return view('admin_core.content.motel.report', [
            'totalAmount' => $totalAmount,
            'totalElectric' => $totalElectric,
            'totalWater' => $totalWater,
            'invoices' => $invoices,
            'allMotels' => $allMotels,
            'motels' => $motels,
            'totalMotelIncome' => $totalMotelIncome,
            'totalElectricIncome' => $totalElectricIncome,
            'totalWaterIncome' => $totalWaterIncome,
            'totalWifiIncome' => $totalWifiIncome,
            'totalOtherIncome' => $totalOtherIncome,
        ]);
    }
    public function payInvoice($id)
    {

        $invoice = Invoice::findOrFail($id);
        $getMotelName = Motel::findOrFail($invoice->motel_id);

//            dd($getMotelName->name);
        return view('admin_core.content.invoices.pay', compact('invoice','getMotelName'));
    }
    public function getIndexInvoice()
    {
        $getUserId = Auth::id();
        $invoices = Invoice::where('user_id', $getUserId)->with('motel')->get();
        return view('admin_core.content.motel.list', compact('invoices'));
    }
    public function prepay(Request $request)
    {

        $request->validate([
            'total_amount' => 'required|',
            'prepay' => 'required|',
        ]);
        $invoiceId = $request->input('invoiceId')  ;
        $invoice = Invoice::findOrFail($invoiceId);
        $prepay1 = $invoice->prepay ;
        $prepay =  $request->input('prepay');
        $totalPay = $prepay1 +$prepay;
        $invoice->prepay = $totalPay;
        $invoice->total_amount = $request->input('total_amount');
        $invoice->save();
        return redirect()->back()->with('success', 'Hóa đơn đã được trả trước thành công!');
    }
    public function acceptPay(Request $request, $id)
    {
        // Lấy thông tin hóa đơn từ DB
        $invoice = Invoice::findOrFail($id);

        // Cập nhật trạng thái hóa đơn
        $invoice->status = 'paid'; // 'paid' là trạng thái đã thanh toán
        $invoice->paid_at = now(); // Ghi nhận thời gian thanh toán
//        dd($invoice);
        $invoice->save();

        // Điều hướng hoặc trả về thông báo thành công
        return redirect()->route('admin.invoices.getIndexInvoice')->with('success', 'Hóa đơn đã được thanh toán thành công!');
    }
}
