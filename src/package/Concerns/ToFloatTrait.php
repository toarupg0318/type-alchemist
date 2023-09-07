<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use Exception;
use TypeError;

/**
 * @internal
 * @property mixed $value
 */
trait ToFloatTrait
{
    /**
     * @return float|null
     */
    public function toSafeFloat(): float|null
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
            return floatval($this->value);
        }

        return null;
    }

    /**
     * @param Exception|null $exception
     * @return float
     *
     * @throws Exception|TypeError
     */
    public function toStrictFloat(Exception $exception = null): float
    {
        $return = self::toSafeFloat();

        if (is_null($return)) {
            if (is_null($exception)) {
                throw new TypeError();
            } else {
                throw $exception;
            }
        }

        return $return;
    }
}