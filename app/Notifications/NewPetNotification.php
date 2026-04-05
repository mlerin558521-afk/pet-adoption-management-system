<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPetNotification extends Notification
{
    use Queueable;
    protected $petName;

    public function __construct($petName)
    {
        $this->petName = $petName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "🐾 There's a new pet added: {$this->petName}. Would you like to check it out?"
        ];
    }
}

