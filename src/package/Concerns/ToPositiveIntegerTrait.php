<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use Throwable;
use TypeError;

/**
 * @property mixed $value
 */
trait ToPositiveIntegerTrait
{
    /**
     * @return positive-int|null
     */
    public function __toSafePositiveInt(): int|null
    {
        if (is_int($this->value) && $this->value > 0) {
            return $this->value;
        }

        return null;
    }

    /**
     * @return positive-int
     *
     * @throws Throwable|TypeError
     */
    public function __toStrictPositiveInt(string|null $exception = null): int
    {
        $positiveIntScalarValue = self::__toSafePositiveInt();
        if (is_null($positiveIntScalarValue)) {
            if (
                !is_null($exception) &&
                class_exists($exception) &&
                (new $exception) instanceof Throwable
            ) {
                throw new $exception;
            }
            throw new TypeError();
        } else {
            return $positiveIntScalarValue;
        }
    }
}