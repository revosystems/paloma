<?php

namespace Revo\Paloma;

use Nexmo\Laravel\Facade\Nexmo;
use Nexmo\Message\Message as NexmoResponse;
use Revo\Paloma\Exceptions\SmsException;

class Sender implements Contracts\Sender
{
    /**
     * @throws SmsException
     */
    public function send(string $phone, string $message)
    {
        try {
            $smsResponse = Nexmo::message()->send([
                'from' => config('paloma.sms_from'),
                'to' => $phone,
                'text' => $message,
            ]);
        } catch (\RuntimeException $e) {
            throw new SmsException($e->getMessage());
        }

        throw_if($this->getStatus($smsResponse) != 0, SmsException::class, "The message failed with status: {$this->getStatus($smsResponse)}");
    }

    protected function getStatus(NexmoResponse $smsResponse): int|null
    {
        return $smsResponse->current()['status'] ?? null;
    }
}
