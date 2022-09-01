<?php

namespace Revo\Paloma;

use Revo\Paloma\Facades\Paloma;

class PalomaChannel
{
    public function send($notifiable, $notification)
    {
        $message = $notification->toPaloma($notifiable);

        Paloma::send($notifiable->full_phone, $message->message, $message->service, $message->from);
    }
}
