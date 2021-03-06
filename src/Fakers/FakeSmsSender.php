<?php

namespace Revo\Paloma\Fakers;

use Revo\Paloma\Contracts\Sender;
use Revo\Paloma\Exceptions\SmsException;

class FakeSmsSender implements Sender
{
    public function __construct(protected bool $shouldFail = false)
    {
    }

    /**
     * @throws SmsException
     */
    public function send(string $phone, string $message, ?string $from = null)
    {
        throw_if($this->shouldFail, SmsException::class, 'Sms failed to send.');
    }
}
