<?php

namespace Revo\Paloma\Contracts;

interface Sender
{
    /**
     * @throws SmsException
     */
    public function send(string $phone, string $message, ?string $from = null);
}
