@foreach ($notifications as $notification)
<div class="notification">
    <p>{{ $notification->data['message'] }}</p>
    <small>Hết hạn vào: {{ $notification->data['end_date'] }}</small>
</div>
@endforeach
