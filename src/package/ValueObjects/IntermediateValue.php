<?php

declare(strict_types=1);

namespace Toarupg0318\TypeAlchemist\ValueObjects;

use Toarupg0318\TypeAlchemist\Concerns\ToPositiveIntegerTrait;
use Toarupg0318\TypeAlchemist\Concerns\ToStringTrait;

final class IntermediateValue
{
    use ToStringTrait;
    use ToPositiveIntegerTrait;

    public function __construct(
        public readonly mixed $value
    ) {
    }
}