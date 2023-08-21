<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist;

use Toarupg0318\TypeAlchemist\ValueObjects\IntermediateValue;

if (! function_exists('alchemy')) {
    function alchemy(mixed $value): IntermediateValue
    {
        return Alchemist::alchemy($value);
    }
}
