<?php

namespace Revo\Paloma\Contracts;

interface Sender
{
    public function message();

    public function send(array $values);

    public function current(): array;
}
