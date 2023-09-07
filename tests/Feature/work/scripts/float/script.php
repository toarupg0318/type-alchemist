<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

/** @var mixed $value */
$value = new stdClass();

/**
 * @param float|null $value
 * @return void
 */
$handleSafeFloat = function (float|null $value) {
    var_dump($value);
};
$handleSafeFloat(alchemy($value)->toSafeFloat());

/**
 * @param float $value
 * @return void
 */
$handleStrictFloat = function (float $value) {
    var_dump($value);
};
$handleStrictFloat(alchemy($value)->toStrictFloat());
