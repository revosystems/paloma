<?php

namespace Revo\Paloma\Contracts;

interface Sender
{
    public function message(): static;

    public function send(array $values): static;

    public function current(): array;
}
