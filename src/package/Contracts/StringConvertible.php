<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Contracts;

use Exception;
use TypeError;

interface StringConvertible
{
    /**
     * @return string|null
     */
    public function toSafeString(): string|null;

    /**
     * You could customize Exception to throw with second argument whatever you want.
     *
     * @param Exception|null $exception
     * @return string
     *
     * @throws Exception|TypeError
     */
    public function toStrictString(Exception $exception = null): string;

    /**
     * If the class-string value of Passed $targetClass is invalid, returns null safely.
     *
     * @template T
     * @param class-string<T> $targetClass
     * @return class-string<T>|null
     */
    public function toSafeClassString(string $targetClass): string|null;

    /**
     * If the class-string value of Passed $targetClass is invalid, throws TypeError by default.
     * You could customize Exception to throw with second argument whatever you want.
     *
     * @template T
     * @param class-string<T> $targetClass
     * @param Exception|null $exception
     * @return class-string<T>
     *
     * @throws Exception|TypeError
     */
    public function toStrictClassString(
        string $targetClass,
        Exception $exception = null
    ): string;
}