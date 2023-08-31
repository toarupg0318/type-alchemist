<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Contracts;

use TypeError;

interface IntegerConvertible
{
    /**
     * @return int|null
     */
    public function toSafeInt(): int|null;

    /**
     * @return int
     *
     * @throws TypeError
     */
    public function toStrictInt(): int;

    /**
     * @return positive-int|null
     */
    public function toSafePositiveInt(): int|null;

    /**
     * @return positive-int
     *
     * @throws TypeError
     */
    public function toStrictPositiveInt(): int;
}