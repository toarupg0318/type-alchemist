<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

/**
 * @param int|null $value
 * @return void
 */
$handleSafeInt = function (int|null $value) {
    var_dump($value);
};
$handleSafeInt(alchemy($value)->toSafeInt());

/**
 * @param positive-int|null $value
 * @return void
 */
$handleSafePositiveInt = function (int|null $value) {
    var_dump($value);
};
$handleSafePositiveInt(alchemy($value)->toSafePositiveInt());

/**
 * @param positive-int $value
 * @return void
 */
$handleStrictPositiveInt = function (int $value) {
    var_dump($value);
};
$handleSafePositiveInt(alchemy($value)->toStrictPositiveInt());
