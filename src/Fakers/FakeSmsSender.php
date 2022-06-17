<?php

namespace Revo\Paloma\Fakers;

use Revo\Paloma\Contracts\Sender;
use Revo\Paloma\Exceptions\SmsException;

class FakeSmsSender implements Sender
{
    public function __construct(protected bool $shouldFail = false)
    {
    }

    public function send(string $phone, string $message)
    {
        throw_if($this->shouldFail, SmsException::class, 'Sms failed to send.');
    }
}
