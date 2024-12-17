<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Rooms;

class VipExpired extends Notification
{

    public $room;

    public function __construct(Rooms $room)
    {
        $this->room = $room;
    }

    // Chọn kênh notification (ở đây là database)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Nội dung notification khi được lưu vào database
    public function toDatabase($notifiable)
    {
        return [
            'room_id'    => $this->room->id,
            'room_title' => $this->room->title,
            'message'    => "Gói VIP của phòng '{$this->room->title}' đã hết hạn và đã chuyển về gói thường.",
            'end_date'   => $this->room->vipPurchases->end_date ?? null,
        ];
    }

}
