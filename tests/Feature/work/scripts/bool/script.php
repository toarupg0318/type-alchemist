<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

$value = new stdClass();

// basic bool
/**
 * @param bool|null $value
 * @return void
 */
$handleSafeBool = function (bool|null $value) {
    var_dump($value);
};
$handleSafeBool(alchemy($value)->toSafeBool());

/**
 * @param bool $value
 * @return void
 */
$handleStrictBool = function (bool $value) {
    var_dump($value);
};
$handleStrictBool(alchemy($value)->toStrictBool());

// bool false
/**
 * @param false|null $value
 * @return void
 */
$handleSafeFalse = function (bool|null $value) {
    var_dump($value);
};
$handleSafeFalse(alchemy($value)->toSafeFalse());

/**
 * @param false $value
 * @return void
 */
$handleStrictFalse = function (bool $value) {
    var_dump($value);
};
$handleStrictFalse(alchemy($value)->toStrictBool());

// bool true
/**
 * @param true|null $value
 * @return void
 */
$handleSafeTrue = function (bool|null $value) {
    var_dump($value);
};
$handleSafeTrue(alchemy($value)->toSafeTrue());

/**
 * @param true $value
 * @return void
 */
$handleStrictTrue = function (bool $value) {
    var_dump($value);
};
$handleStrictTrue(alchemy($value)->toStrictTrue());