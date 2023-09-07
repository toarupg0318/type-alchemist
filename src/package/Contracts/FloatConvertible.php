<?php

namespace Toarupg0318\TypeAlchemist\Contracts;

use Exception;
use TypeError;

interface FloatConvertible
{
    /**
     * @return float|null
     */
    public function toSafeFloat(): float|null;

    /**
     * @param Exception|null $exception
     * @return float
     *
     * @throws Exception|TypeError
     */
    public function toStrictFloat(Exception $exception = null): float;
}