<?php

namespace Revo\Paloma\Fakers;

use Revo\Paloma\Contracts\Sender;

class FakeSmsSender implements Sender
{
    protected array $current;

    public function __construct(bool $shouldFail = false)
    {
        $this->current = ['status' => strval((int)$shouldFail)];
    }

    public function message(): static
    {
        return $this;
    }

    public function send(array $values): static
    {
        return $this;
    }

    public function current(): array
    {
        return $this->current;
    }
}
