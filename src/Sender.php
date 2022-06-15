<?php

namespace Revo\Paloma;

use Nexmo\Laravel\Facade\Nexmo;
use Revo\Paloma\Exceptions\SmsException;

class Sender implements Contracts\Sender
{
    protected $smsResponse;

    public function send(string $phone, string $message)
    {
        try {
            $this->smsResponse = Nexmo::message()->send([
                'from' => config('paloma.sms_from'),
                'to' => $phone,
                'text' => $message,
            ]);
        } catch (\Exception $e) {
            throw new SmsException($e->getMessage());
        }
        return $this;
    }

    public function hasFailed(): bool
    {
        return $this->smsResponse->current()['status'] != 0;
    }

    public function errorMessage(): string
    {
        return 'The message failed with status: ' . $this->smsResponse->current()['status'];
    }
}
