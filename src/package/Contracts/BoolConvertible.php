<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Contracts;

use Exception;
use TypeError;

interface BoolConvertible
{
    /**
     * @return bool|null
     */
    public function toSafeBool(): bool|null;

    /**
     * @param Exception|null $exception
     * @return bool
     *
     * @throws Exception|TypeError
     */
    public function toStrictBool(Exception $exception = null): bool;

    /**
     * @return false|null
     */
    public function toSafeFalse(): bool|null;

    /**
     * @param Exception|null $exception
     * @return false
     *
     * @throws Exception|TypeError
     */
    public function toStrictFalse(Exception $exception = null): bool;

    /**
     * @return true|null
     */
    public function toSafeTrue(): bool|null;

    /**
     * @param Exception|null $exception
     * @return true
     *
     * @throws Exception|TypeError
     */
    public function toStrictTrue(Exception $exception = null): bool;
}