<?php

declare(strict_types = 1);

namespace Src\TimeTracker\Domain\ValueObjects;


final class TaskStartTime
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}
