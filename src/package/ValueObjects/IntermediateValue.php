<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\ValueObjects;

use Exception;
use Toarupg0318\TypeAlchemist\Concerns\ToBoolTrait;
use Toarupg0318\TypeAlchemist\Concerns\ToFloatTrait;
use Toarupg0318\TypeAlchemist\Concerns\ToIntegerTrait;
use Toarupg0318\TypeAlchemist\Concerns\ToStringTrait;
use Toarupg0318\TypeAlchemist\Contracts\BoolConvertible;
use Toarupg0318\TypeAlchemist\Contracts\FloatConvertible;
use Toarupg0318\TypeAlchemist\Contracts\IntegerConvertible;
use Toarupg0318\TypeAlchemist\Contracts\StringConvertible;
use TypeError;

final class IntermediateValue implements IntegerConvertible, StringConvertible, BoolConvertible, FloatConvertible
{
    use ToStringTrait;
    use ToIntegerTrait;
    use ToBoolTrait;
    use ToFloatTrait;

    public function __construct(
        public readonly mixed $value
    ) {
    }

    /**
     * @return positive-int|null
     */
    public function toSafePositiveInt(): int|null
    {
        $result = $this->toSafeInt();

        if (is_null($result) || $result < 1) {
            return null;
        }

        return $result;
    }

    /**
     * @param Exception|null $exception
     * @return positive-int
     *
     * @throws Exception|TypeError
     */
    public function toStrictPositiveInt(Exception $exception = null): int
    {
        $result = $this->toSafeInt();

        if (is_null($result) || $result < 1) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $result;
    }

    /**
     * @template T
     * @param class-string<T> $targetClass
     * @return class-string<T>|null
     */
    public function toSafeClassString(string $targetClass): string|null
    {
        $result = $this->toSafeString();

        if (is_null($result) || $result !== $targetClass) {
            return null;
        }

        return $result;
    }

    /**
     * @template T
     * @param class-string<T> $targetClass
     * @param Exception|null $exception
     * @return class-string<T>
     *
     * @throws TypeError|Exception
     */
    public function toStrictClassString(
        string $targetClass,
        Exception|null $exception = null
    ): string {
        if (! class_exists($targetClass)) {
            throw new TypeError();
        }

        $result = $this->toSafeString();

        if (is_null($result) || $result !== $targetClass) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $result;
    }

    /**
     * @return negative-int|null
     */
    public function toSafeNegativeInt(): int|null
    {
        $result = $this->toSafeInt();

        if (is_null($result) || $result > -1) {
            return null;
        }

        return $result;
    }

    /**
     * @param Exception|null $exception
     * @return negative-int
     *
     * @throws Exception|TypeError
     */
    public function toStrictNegativeInt(Exception $exception = null): int
    {
        $result = $this->toSafeInt();

        if (is_null($result) || $result > -1) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $result;
    }

    /**
     * @return false|null
     */
    public function toSafeFalse(): bool|null
    {
        $return = self::toSafeBool();

        if (is_null($return) || $return !== false) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return false
     *
     * @throws Exception|TypeError
     */
    public function toStrictFalse(Exception $exception = null): bool
    {
        $return = self::toSafeFalse();

        if (is_null($return)) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $return;
    }

    /**
     * @return true|null
     */
    public function toSafeTrue(): bool|null
    {
        $return = self::toSafeBool();

        if ($return !== true) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return true
     *
     * @throws Exception|TypeError
     */
    public function toStrictTrue(Exception $exception = null): bool
    {
        $return = self::toSafeTrue();

        if (is_null($return)) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $return;
    }

    /**
     * @return non-positive-int|null
     */
    public function toSafeNonPositiveInt(): int|null
    {
        $return = self::toSafeInt();

        if (is_null($return) || $return > 0) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return non-positive-int
     *
     * @throws TypeError|Exception
     */
    public function toStrictNonPositiveInt(Exception $exception = null): int
    {
        $return = self::toSafeNonPositiveInt();

        if (is_null($return)) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $return;
    }

    /**
     * @return non-negative-int|null
     */
    public function toSafeNonNegativeInt(): int|null
    {
        $return = self::toSafeInt();

        if (is_null($return) || $return < 0) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return non-negative-int
     *
     * @throws Exception|TypeError
     */
    public function toStrictNonNegativeInt(Exception $exception = null): int
    {
        $return = self::toSafeNonNegativeInt();

        if (is_null($return)) {
            if ($exception !== null) {
                throw $exception;
            } else {
                throw new TypeError();
            }
        }

        return $return;
    }

    /**
     * @return non-zero-int|null
     */
    public function toSafeNonZeroInt(): int|null
    {
        $return = self::toSafeInt();

        if (is_null($return) || $return === 0) {
            return null;
        }

        return $return;
    }

    /**
     * @param Exception|null $exception
     * @return non-zero-int
     *
     * @throws TypeError|Exception
     */
    public function toStrictNonZeroInt(Exception $exception = null): int
    {
        $return = self::toSafeNonZeroInt();

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