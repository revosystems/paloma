<?php

namespace Revo\Paloma;

use Revo\Paloma\Contracts\Sender;
use Revo\Paloma\Exceptions\SmsException;
use Revo\Paloma\Exceptions\TenantCannotSendSmsException;
use Revo\Paloma\Models\SentSms;

/**
 * @throws SmsException
 * @throws TenantCannotSendSmsException
 */
class Paloma
{
    public function __construct(protected Sender $sender)
    {}

    public function send(string $phone, string $message, string $service)
    {
        throw_unless($this->hasBalance(), TenantCannotSendSmsException::class);

        $smsResponse = $this->sender->send($phone, $message);

        throw_if($smsResponse->hasFailed(), SmsException::class, $smsResponse->errorMessage());

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
