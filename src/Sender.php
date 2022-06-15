<?php

namespace Revo\Paloma;

use Nexmo\Laravel\Facade\Nexmo;
use Nexmo\Message\Message as NexmoResponse;

class Sender implements Contracts\Sender
{
    protected ?string $errorMessage = null;

    public function send(string $phone, string $message)
    {
        try {
            $smsResponse = Nexmo::message()->send([
                'from' => config('paloma.sms_from'),
                'to' => $phone,
                'text' => $message,
            ]);
        } catch (\RuntimeException $e) {
            $this->errorMessage = $e->getMessage();
        }
        
        if ($this->hasFailed($smsResponse)) {
            $this->errorMessage = 'The message failed with status: ' . $this->smsResponse->current()['status'];
        }
    }

    public function errorMessage(): ?string
    {
        return $this->errorMessage;
    }

    protected function hasFailed(NexmoResponse $smsResponse): bool
    {
        return $smsResponse->current()['status'] != 0;
    }
}
