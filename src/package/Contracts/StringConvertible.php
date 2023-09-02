<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\Contracts;

use TypeError;

interface StringConvertible
{
    /**
     * @return string|null
     */
    public function toSafeString(): string|null;

    /**
     * @return string
     *
     * @throws TypeError
     */
    public function toStrictString(): string;

    /**
     * If the class-string value of Passed $targetClass is invalid, returns null safely.
     *
     * @template T
     * @param class-string<T> $targetClass
     * @return class-string<T>|null
     */
    public function toSafeClassString(string $targetClass): string|null;

    /**
     * If the class-string value of Passed $targetClass is invalid, throws TypeError.
     *
     * @template T
     * @param class-string<T> $targetClass
     * @return class-string<T>
     *
     * @throws TypeError
     */
    public function toStrictClassString(string $targetClass): string;
}