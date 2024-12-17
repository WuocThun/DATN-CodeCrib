<?php
namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoiceExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $getUserId = Auth::id();

        return Invoice::where([
            ['user_id', '=', $getUserId],
            ['status', '=', 'paid'],
        ])->get();
    }

    // Định nghĩa tiêu đề của các cột
    public function headings(): array
    {
        return [
            'Mã hoá đơn',
            'Tên phòng',
            'Tiền điện',
            'Tiền nước',
            'Tiền phụ thu',
            'Tổng tiền',
            'Trạng thái',
        ];
    }

    // Định nghĩa dữ liệu cho từng cột
    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->motel->name,
            number_format(($invoice->new_electric - $invoice->old_electric) * $invoice->electric_fee, 0, ',', '.') . ' VNĐ',
            number_format(($invoice->new_water - $invoice->old_water) * $invoice->water_fee, 0, ',', '.') . ' VNĐ',
            number_format($invoice->money_another , 0, ',', '.') . ' VNĐ',
            number_format($invoice->total_amount, 0, ',', '.') . ' VNĐ',
            ucfirst($invoice->status),
        ];
    }
}
