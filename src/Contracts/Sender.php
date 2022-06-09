<?php

namespace Revo\Paloma\Contracts;

interface Sender
{
     public function message(): static;
     public function send(): static;
     public function current(): array;
}
