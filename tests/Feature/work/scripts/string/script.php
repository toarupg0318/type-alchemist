<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

/**
 * @param class-string<Alchemist>|null $value
 * @return void
 */
$handleSafeClassString = function (string|null $value) {
    var_dump($value);
};
$handleSafeClassString(
    alchemy(Alchemist::class)
        ->toSafeClassString(Alchemist::class)
);
