<div class="user_quick_info js-mobile-user-quick-info">
    <p style="margin-top: 0; margin-bottom: 5px;">Xin chào <strong>{{auth()->user()->name}}</strong>. Mã tài khoản:
        <strong>{{auth()->id()}}</strong>
    </p>
    <p style="margin-bottom: 0;">Số dư TK của bạn là: <strong>{{number_format(auth()->user()->balance,0,',', '.')}} VND</strong></p>
</div>

