<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use Stringable;
use Throwable;
use TypeError;

/**
 * @property mixed $value
 */
trait ToStringTrait
{
    public function __toSafeString(): string|null
    {
        if (
            is_string($this->value) ||
            is_bool($this->value) ||
            is_float($this->value) ||
            is_int($this->value) ||
            is_resource($this->value) ||
            is_null($this->value)
        ) {
            return strval($this->value);
        } elseif ($this->value instanceof Stringable) {
            return strval($this->value);
        }

        return null;
    }

    /**
     * @param class-string<Throwable>|null $exception
     * @return string
     *
     * @throws Throwable|TypeError
     */
    public function __ToStrictString(
        string|null $exception = null
    ): string {
        $scalarStringValue = self::__toSafeString();
        if (is_null($scalarStringValue)) {
            if (
                !is_null($exception) &&
                class_exists($exception) &&
                (new $exception) instanceof Throwable
            ) {
                throw new $exception;
            }
            throw new TypeError();
        } else {
            return $scalarStringValue;
        }
    }
}