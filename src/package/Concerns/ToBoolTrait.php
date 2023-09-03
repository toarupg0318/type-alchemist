<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Concerns;

use Exception;
use TypeError;

/**
 * @internal
 * @property mixed $value
 */
trait ToBoolTrait
{
    /**
     * @return bool|null
     */
    public function toSafeBool(): bool|null
    {
        $return = boolval($this->value);

        if (! is_bool($return)) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return bool
     *
     * @throws Exception|TypeError
     */
    public function toStrictBool(Exception $exception = null): bool
    {
        $return = self::toSafeBool();

        if (is_null($return)) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $return;
    }
}