<?php

namespace Revo\Paloma;

use Revo\Paloma\Contracts\Sender;
use Revo\Paloma\Exceptions\SmsException;
use Revo\Paloma\Exceptions\TenantCannotSendSmsException;
use Revo\Paloma\Models\SentSms;

class Paloma
{
    public function __construct(protected Sender $sender)
    {
    }

    /**
     * @throws SmsException
     * @throws TenantCannotSendSmsException
     */
    public function send(string $phone, string $message, string $service)
    {
        throw_unless($this->hasBalance(), TenantCannotSendSmsException::class);

        $this->sender->send($phone, $message);

        $this->logSms($phone, $message, $service);

        return true;
    }

    protected function hasBalance(): bool
    {
        return true;
    }

    private function logSms(string $phone, string $message, string $service)
    {
        SentSms::create([
            'phone' => $phone,
            'message' => $message,
            'service' => $service,
        ]);
    }
}
