
@extends('admin_core.layouts.test')

@section('main')
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <main role="main" class="ml-sm-auto col">
        <div class="no-print">
            @include('admin_core.inc.sub_main')
        </div>
        <div class="no-print">
            <a href="{{route('admin.motel.create')}}">
                <button type="button" class="mb-3 mt-2 btn btn-secondary">Thêm phòng</button>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <img src="{{asset('uploads/logoCodeCrib.png')}}" class="rounded mx-auto d-none d-print-block" alt="...">
            <div class="card-header">
                <p>Ngày tạo thanh toán: {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }} </p>
                <p>Tên phòng : {{$getMotelName->name}}</p>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Loại tiền</th>
                        <th scope="col">Chỉ số</th>
                        <th scope="col">Số tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Tiền phòng</th>
                        <td></td>
                        <td>{{ number_format($invoice->money,0,',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row">Tiền điện</th>
                        <td>( {{$invoice->new_electric}}kWH - {{$invoice->old_electric}}kWH
                            = {{$invoice->new_electric - $invoice->old_electric }} kWH
                            x {{ number_format($invoice->money_electric,0,',', '.') }} VNĐ) =
                        </td>
                        <td>{{ number_format($invoice->electric_fee,0,',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row">Tiền nước</th>
                        <td>( {{$invoice->new_water}}kWH - {{$invoice->old_water}}kWH
                            = {{$invoice->new_water- $invoice->old_water }} kWH
                            x {{ number_format($invoice->money_water,0,',', '.') }} VNĐ) =
                        </td>
                        <td>{{ number_format($invoice->water_fee,0,',', '.') }} VNĐ</td>
                    </tr>
                    @if(!isset($invoice->prepay))

                    @else

                    <tr>
                        <th scope="row">Số tiền ban đầu</th>
                        <td></td>
                        <td  class="fw-bold text-primary">{{ number_format($invoice->all_money,0,',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row">Thanh toán trước</th>
                        <td>Số tiền phòng hiện tại - tiền đã trả trước = {{ number_format($invoice->prepay,0,',', '.') }} VNĐ
                        </td>
                        <td>{{ number_format($invoice->prepay,0,',', '.') }} VNĐ</td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row">Tiền khác ( WIFI + RÁC,..)</th>
                        <th ></th>
                        <td class="fw-bold text-danger">{{ number_format($invoice->money_another,0,',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td class="fw-bold text-danger">Tổng tiền</td>
                        <td class="fw-bold text-danger">{{ number_format($invoice->total_amount,0,',', '.') }} VNĐ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="no-print row ml-3 mb-3">
                <div class="col-md-4">
                    <button onclick="window.print()" class="btn btn-info">In hoá đơn</button>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.invoices.acceptPay', $invoice->id) }}" method="POST"
                          onsubmit="return confirm('Bạn có chắc chắn muốn thanh toán hóa đơn này?');">
                        @csrf
                        <button type="submit" class="btn btn-warning">Thanh toán</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#addMemberModal{{$invoice->id}}">
                        Thanh toán và nợ
                    </button>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="addMemberModal{{$invoice->id}}" tabindex="-1" aria-labelledby="addMemberModalLabel{{$invoice->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel{{$invoice->id}}">Thông tin hoá đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.invoices.prepay')}}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="old_electric_{{$invoice->id}}" class="form-label text-dark">Tổng tiền</label>
                                    <input type="text" class="form-control" disabled value="{{ number_format($invoice->total_amount,0,',', '.') }} VNĐ"  name="">
                                    <input type="text" class="form-control" hidden value="{{$invoice->id}}"  name="invoiceId">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="prepaid_amount_{{$invoice->id}}" class="form-label text-dark">Số tiền thanh toán trước</label>
                                    <input type="number" id="prepaid_amount_{{$invoice->id}}"
                                           class="form-control currency-input"
                                           max="{{$invoice->total_amount}}"
                                           min="0"
                                           name="prepay"
                                           placeholder="Nhập số tiền thanh toán trước">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="remaining_amount_{{$invoice->id}}" class="form-label text-dark">Số tiền còn nợ</label>
                                    <input type="number" id="remaining_amount_{{$invoice->id}}"
                                           class="form-control currency-input"
                                           readonly
                                           name="total_amount"
                                           value="{{$invoice->total_amount}}">
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-info">Trả trước</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    document.querySelector('.currency-input').addEventListener('input', function (e) {
        const max = parseInt(e.target.getAttribute('max'));
        const min = parseInt(e.target.getAttribute('min'));
        let value = parseInt(e.target.value);

        if (value > max) {
            e.target.value = max; // Nếu vượt quá max, tự động đặt giá trị bằng max
        } else if (value < min) {
            e.target.value = min; // Nếu nhỏ hơn min, tự động đặt giá trị bằng min
        }
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const prepaidInput = document.getElementById('prepaid_amount_{{$invoice->id}}');
            const remainingInput = document.getElementById('remaining_amount_{{$invoice->id}}');
            const totalAmount = {{$invoice->total_amount}};

            prepaidInput.addEventListener('input', function () {
                let prepaidValue = parseFloat(prepaidInput.value) || 0; // Lấy giá trị nhập hoặc 0 nếu trống
                if (prepaidValue > totalAmount) {
                    prepaidValue = totalAmount; // Không cho phép vượt quá tổng số tiền
                    prepaidInput.value = prepaidValue;
                }
                const remainingValue = totalAmount - prepaidValue; // Tính số tiền còn nợ
                remainingInput.value = remainingValue.toFixed(0); // Hiển thị số tiền còn nợ
            });
        });

    </script>
@endsection

