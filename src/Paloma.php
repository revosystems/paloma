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
    protected string $tenant;

    public function __construct(protected Sender $sender, string $tenant = null)
    {
        $usernameField = config('paloma.usernameField', 'tenant');
        $this->tenant = $tenant ?? auth()->user()->$usernameField;
    }

    public function send(string $phone, string $message, string $service)
    {
        if (! $this->hasBalance()) {
            throw new TenantCannotSendSmsException();
        }

        try {
            $smsResponse = $this->sender->message()->send([
                'from' => config('paloma.sms_from'),
                'to' => $phone,
                'text' => $message,
            ]);
        } catch (\Exception $e) {
            throw new SmsException($e->getMessage());
        }

        $smsResponseStatus = $smsResponse->current()['status'];
        if ($smsResponseStatus != 0) {
            throw new SmsException("Error status: {$smsResponseStatus}");
        }

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
