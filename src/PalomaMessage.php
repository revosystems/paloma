<?php

namespace Revo\Paloma;

class PalomaMessage {

    public function __construct(
        protected string $message,
        protected string $service,
        protected ?string $from = null,
    ) {}

    public function __get($name): mixed
    {
        return $this->$name ?? null;
    }

    public function __isset($name): bool
    {
        return isset($this->$name);
    }
}