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

// non-positive-int
/**
 * @param non-positive-int|null $value
 * @return void
 */
$handleSafeNonPositiveInt = function (int|null $value) {
    var_dump($value);
};
$handleSafeNonPositiveInt(alchemy($value)->toSafeNonPositiveInt());

/**
 * @param non-positive-int $value
 * @return void
 */
$handleStrictNonPositiveInt = function (int $value) {
    var_dump($value);
};
$handleStrictNonPositiveInt(alchemy($value)->toStrictNonPositiveInt());
$handleStrictNonPositiveInt(alchemy($value)->toStrictNonPositiveInt(new LogicException()));

/**
 * @param non-zero-int|null $value
 * @return void
 */
$handleSafeNonZeroInt = function (int|null $value) {
    var_dump($value);
};
$handleSafeNonZeroInt(alchemy($value)->toSafeNonZeroInt());

// non-zero-int
/**
 * @param non-zero-int $value
 * @return void
 */
$handleSafeNonZeroIntClass = new class () {
    /**
     * @param non-zero-int|null $value
     * @return void
     */
    public function handle(int|null $value): void
    {
        var_dump($value);
    }
};
$handleSafeNonZeroIntClass->handle(alchemy($value)->toSafeNonZeroInt());

$handleStrictNonZeroIntClass = new class () {
    /**
     * @param non-zero-int $value
     * @return void
     */
    public function handle(int $value): void
    {
        var_dump($value);
    }
};
$handleStrictNonZeroIntClass->handle(alchemy($value)->toStrictNonZeroInt());