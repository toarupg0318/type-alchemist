<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

// basic integer
/**
 * @param int|null $value
 * @return void
 */
$handleSafeInt = function (int|null $value) {
    var_dump($value);
};
$handleSafeInt(alchemy($value)->toSafeInt());

// positive-int
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
$handleStrictPositiveInt(alchemy($value)->toStrictPositiveInt());

// negative-int
/**
 * @param negative-int|null $value
 * @return void
 */
$handleSafeNegativeInt = function (int|null $value) {
    var_dump($value);
};
$handleSafeNegativeInt(alchemy($value)->toSafeNegativeInt());

/**
 * @param negative-int $value
 * @return void
 */
$handleStrictNegativeInt = function (int $value) {
    var_dump($value);
};
$handleStrictNegativeInt(alchemy($value)->toStrictNegativeInt());
$handleStrictNegativeInt(alchemy($value)->toStrictNegativeInt(new LogicException()));