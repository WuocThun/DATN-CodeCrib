@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<p>Số dư tài khoản: {{ auth()->user()->balance }} VND</p>


<form action="{{ route('admin.balance.sandboxPayment') }}" method="POST">
    @csrf
    <label for="amount">Nhập số tiền muốn nạp:</label>
    <input type="text" disabled name="description" >Nạp Vip cho tài khoản {{auth()->user()->name}}
    <input type="number" name="amount" id="amount" min="1" required> <br>
    <button type="submit" class="btn btn-success">Nạp tiền</button>
</form>

<div class="alert alert-warning" role="alert">
    <p><strong>Lưu ý quan trọng:</strong></p>
    <p>- Nội dung chuyển tiền bạn vui lòng ghi đúng thông tin sau:</p><p>
    </p><p><strong style="color: red;">"PT123 - {{auth()->user()->id}} -  {{auth()->user()->phone_number}}"</strong></p>
    <p>Trong đó {{auth()->user()->id}} là mã thành viên,  {{auth()->user()->phone_number}} là số điện thoại của bạn đăng ký trên website phongtro123.com.</p>
    <p>Xin cảm ơn!</p>
</div>

<div class="d-none d-md-block">
    <table border="1px" class="table table-bordered table-striped">
        <tbody>
        <tr>
            <td><strong>Ngân hàng</strong></td>
            <td><strong>Chủ tài khoản</strong></td>
            <td><strong>Số tài khoản</strong></td>
            <td><strong>Chi nhánh</strong></td>
            <td><strong>Nội dung chuyển khoản</strong></td>
        </tr>
        <tr>
            <td><strong style="color: red;">TECHOMBANK</strong> </td>
            <td style="white-space: nowrap;">HỒ PHẠM QUỐC THUẬN</td>
            <td style="white-space: nowrap;">4010102004<br><button class="btn btn-copy js-btn-copy btn-secondary" title="Sao chép liên kết" data-clipboard-text="4010102004"><span class="icon-copy">Sao chép</span><span class="text">Đã sao chép!</span></button></td>
            <td style="white-space: nowrap;">CN HỒ CHÍ MINH</td>
            <td rowspan="6" style="white-space: nowrap; color: red;">Nội dung chuyển khoản, bạn ghi rõ:<br> <strong>"PT123 - {{auth()->user()->id}} - {{auth()->user()->phone_number}}"</strong><br><button class="btn btn-secondary btn-copy js-btn-copy" title="Sao chép liên kết" data-clipboard-text="PT123 - 144922 - 0906138104"><span class="icon-copy">Sao chép</span><span class="text">Đã sao chép!</span></button></td>
        </tr>

{{--        <tr>--}}
{{--            <td><strong style="color: red;">ACB</strong> - NGÂN HÀNG THƯƠNG MẠI CỔ PHẦN Á CHÂU</td>--}}
{{--            <td style="white-space: nowrap;">Công ty TNHH LBKCORP</td>--}}
{{--            <td style="white-space: nowrap;">150590888<br><button class="btn btn-secondary btn-copy js-btn-copy" title="Sao chép liên kết" data-clipboard-text="150590888"><span class="icon-copy">Sao chép</span><span class="text">Đã sao chép!</span></button></td>--}}
{{--            <td style="white-space: nowrap;">Đông Sài Gòn</td>--}}
{{--            <!-- <td style="white-space: nowrap; color: red;">PT123 - 144922 - 0906138104</td> -->--}}
{{--        </tr>--}}

        </tbody>
    </table>
</div>
@endsection
