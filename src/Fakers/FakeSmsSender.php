<?php

namespace Revo\Paloma\Fakers;

use Revo\Paloma\Contracts\Sender;

class FakeSmsSender implements Sender
{
    public function __construct(protected bool $shouldFail = false)
    {
    }

    public function send(string $phone, string $message)
    {
    }

    public function errorMessage(): ?string
    {
        return $this->shouldFail ? 'Sms failed to send.' : null;
    }
}
