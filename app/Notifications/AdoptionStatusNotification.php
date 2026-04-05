<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdoptionStatusNotification extends Notification
{
    use Queueable;
    protected $status;
    protected $petName;

    public function __construct($status, $petName)
    {
        $this->status = $status;
        $this->petName = $petName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->status === 'approved'
                ? "🎉 Congratulations! Your application for {$this->petName} has been approved!"
                : "❌ Sorry, your application for {$this->petName} has been disapproved. Try again next time."
        ];
    }
}

