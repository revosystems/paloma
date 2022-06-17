<?php

namespace Revo\Paloma;

use Nexmo\Laravel\Facade\Nexmo;
use Nexmo\Message\Message as NexmoResponse;

class Sender implements Contracts\Sender
{
    public function send(string $phone, string $message)
    {
        try {
            $smsResponse = Nexmo::message()->send([
                'from' => config('paloma.sms_from'),
                'to' => $phone,
                'text' => $message,
            ]);
        } catch (\RuntimeException $e) {
            $errorMessage = $e->getMessage();
        }

        if ($this->hasFailed($smsResponse)) {
            $errorMessage = 'The message failed with status: ' . $this->smsResponse->current()['status'];
        }

        throw_if($errorMessage, SmsException::class, $errorMessage);
    }

    protected function hasFailed(NexmoResponse $smsResponse): bool
    {
        return $smsResponse->current()['status'] != 0;
    }
}
