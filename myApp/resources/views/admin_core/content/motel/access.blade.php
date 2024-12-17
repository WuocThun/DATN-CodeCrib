<form action="{{ route('motel.access', $motel->id) }}" method="POST">
    @csrf
    <label for="passcode">Nhập passcode để truy cập phòng:</label>
    <input type="text" id="passcode" name="passcode" required>
    <button type="submit">Xác nhận</button>
</form>
