<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use Stringable;
use TypeError;

/**
 * @property mixed $value
 */
trait ToStringTrait
{
    public function toSafeString(): string|null
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
     * @return string
     *
     * @throws TypeError
     */
    public function toStrictString(): string {
        $scalarStringValue = self::toSafeString();
        if (is_null($scalarStringValue)) {
            throw new TypeError();
        } else {
            return $scalarStringValue;
        }
    }
}