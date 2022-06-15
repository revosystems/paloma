<?php

namespace Revo\Paloma\Contracts;

interface Sender
{
    public function send(string $phone, string $message);
    public function errorMessage(): ?string;
}
