<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

// basic string
/**
 * @param string|null $value
 * @return void
 */
$handleSafeString = function (string|null $value) {
    var_dump($value);
};
$handleSafeString(alchemy($value)->toSafeString());

/**
 * @param string $value
 * @return void
 */
$handleStrictString = function (string $value) {
    var_dump($value);
};
$handleSafeString(alchemy($value)->toStrictString());
$handleSafeString(alchemy($value)->toStrictString(new LogicException()));

// class-string
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

