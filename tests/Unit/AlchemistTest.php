<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\ValueObjects\IntermediateValue;
use function Toarupg0318\TypeAlchemist\alchemy;

test('alchemy performs correctly.', function () {
    expect(true)->toBeTrue()
        ->and(alchemy(new stdClass()))
        ->toBeInstanceOf(IntermediateValue::class);

    // todo: functions
});
