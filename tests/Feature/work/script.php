<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

/**
 * @param positive-int|null $value
 * @return void
 */
$handleSafePositiveInt = function (int|null $value) {
    var_dump($value);
};
$handleSafePositiveInt(alchemy($value)->__toSafePositiveInt());

/**
 * @param positive-int $value
 * @return void
 */
$handleStrictPositiveInt = function (int $value) {
    var_dump($value);
};
$handleSafePositiveInt(alchemy($value)->__toStrictPositiveInt());