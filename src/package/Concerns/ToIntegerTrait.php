<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use TypeError;

/**
 * @property mixed $value
 */
trait ToIntegerTrait
{
    /**
     * @return int|null
     */
    public function toSafeInt(): int|null
    {
        if (
            is_array($this->value) ||
            is_bool($this->value) ||
            is_float($this->value) ||
            is_int($this->value) ||
            is_resource($this->value) ||
            is_string($this->value) ||
            is_null($this->value)
        ) {
            return intval($this->value);
        }

        return null;
    }

    /**
     * @return int
     *
     * @throws TypeError
     */
    public function toStrictInt(): int
    {
        $return = self::toSafeInt();

        if (is_null($return)) {
            throw new TypeError();
        } else {
            return $return;
        }
    }
}