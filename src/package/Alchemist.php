<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist;

use Toarupg0318\TypeAlchemist\ValueObjects\IntermediateValue;

final class Alchemist
{
    public static function alchemy(
        mixed $value
    ): IntermediateValue {
        return new IntermediateValue($value);
    }
}