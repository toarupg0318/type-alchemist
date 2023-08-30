<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use TypeError;

/**
 * @property mixed $value
 */
trait ToPositiveIntegerTrait
{
    /**
     * @return positive-int|null
     */
    public function toSafePositiveInt(): int|null
    {
        if (is_int($this->value) && $this->value > 0) {
            return $this->value;
        }

        return null;
    }

    /**
     * @return positive-int
     *
     * @throws TypeError
     */
    public function toStrictPositiveInt(): int
    {
        $positiveIntScalarValue = self::toSafePositiveInt();
        if (is_null($positiveIntScalarValue)) {
            throw new TypeError();
        } else {
            return $positiveIntScalarValue;
        }
    }
}