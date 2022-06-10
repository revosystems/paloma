<?php


namespace Revo\Paloma;


use Nexmo\Laravel\Facade\Nexmo;

class Sender implements Contracts\Sender
{
    public function message(): static
    {
        return Nexmo::message();
    }

    public function send(array $values): static
    {
        return Nexmo::send($values);
    }

    public function current(): array
    {
        return Nexmo::current();
    }
}
