<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Contracts;

use Exception;
use TypeError;

interface IntegerConvertible
{
    /**
     * @return int|null
     */
    public function toSafeInt(): int|null;

    /**
     * @param Exception|null $exception
     * @return int
     *
     * @throws Exception|TypeError
     */
    public function toStrictInt(Exception $exception = null): int;

    /**
     * @return positive-int|null
     */
    public function toSafePositiveInt(): int|null;

    /**
     * @param Exception|null $exception
     * @return positive-int
     *
     * @throws Exception|TypeError
     */
    public function toStrictPositiveInt(Exception $exception = null): int;
//
//    /**
//     * @return negative-int|null
//     */
//    public function toSafeNegativeInt(): int|null;
//
//    /**
//     * @return negative-int
//     *
//     * @throws TypeError
//     */
//    public function toStrictNegativeInt(): int;
}