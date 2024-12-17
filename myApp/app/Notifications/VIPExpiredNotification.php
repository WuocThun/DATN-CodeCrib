<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class VIPExpiredNotification extends Notification
{
    use Queueable;

    private $roomTitle;

    public function __construct($roomTitle)
    {
        $this->roomTitle = $roomTitle;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your VIP package for the room '{$this->roomTitle}' has expired.",
            'room_title' => $this->roomTitle,
            'expired_at' => now(),
        ];
    }
}
