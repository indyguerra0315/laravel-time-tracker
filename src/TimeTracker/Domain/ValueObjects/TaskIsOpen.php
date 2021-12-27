<?php

declare(strict_types = 1);

namespace Src\TimeTracker\Domain\ValueObjects;

final class TaskIsOpen
{
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }
}
