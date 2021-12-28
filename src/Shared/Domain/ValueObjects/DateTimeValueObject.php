<?php

declare(strict_types = 1);

namespace Src\Shared\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

class DateTimeValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidDateTime($value);

        $this->value = $value;
    }

    public static function now(): self
    {
        return new self((new DateTime())->format('Y-m-d H:i:s'));
    }

    public function value(): string
    {
        return $this->value;
    }

    private function ensureIsValidDateTime($dateString): void
    {
        $format = 'Y-m-d H:i:s';
        $d = DateTime::createFromFormat($format, $dateString);

        if (!($d && $d->format($format) === $dateString)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $dateString));
        }
    }

    public function equals(DateTimeValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function diff(DateTimeValueObject $other): int
    {
        $dteStart = new DateTime($this->value());
        $dteEnd   = new DateTime($other->value());

        $dteDiff  = $dteStart->getTimestamp() - $dteEnd->getTimestamp();

        return $dteDiff;
    }

    public function __toString()
    {
        return $this->value();
    }
}
