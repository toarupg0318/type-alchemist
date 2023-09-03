<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

test('ToBool performs correctly.', function (mixed $input, bool $output) {
    expect(alchemy($input)->toSafeBool())
        ->toBe($output);
})->with([
    [0, false],
    [-1, true],
    [1.0, true],
    [-3.14, true],
    ['true', true],
    ['false', true],
    [true, true],
    [false, false],
    [[], false],
    [[1, 2, 3], true],
    [['key' => 'value'], true],
    [new stdClass(), true],
    [null, false],
    [
        (function () {
            $file = 'file.txt';
            file_put_contents($file, 'Hello World!');
            $resource = fopen($file, 'r');
            if (! is_resource($resource)) {
                throw new Error();
            }
            return $resource;
        })(),
        true
    ],
    [function () {return 'test';}, true],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        true
    ],
    [Alchemist::class, true]
]);

test('ToBool strict mode performs correctly.', function (mixed $input, bool $output) {
    expect(alchemy($input)->toStrictBool())
        ->toBe($output);
})->with([
    [0, false],
    [-1, true],
    [1.0, true],
    [-3.14, true],
    ['true', true],
    ['false', true],
    [true, true],
    [false, false],
    [[], false],
    [[1, 2, 3], true],
    [['key' => 'value'], true],
    [new stdClass(), true],
    [null, false],
    [
        (function () {
            $file = 'file.txt';
            file_put_contents($file, 'Hello World!');
            $resource = fopen($file, 'r');
            if (! is_resource($resource)) {
                throw new Error();
            }
            return $resource;
        })(),
        true
    ],
    [function () {return 'test';}, true],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        true
    ],
    [Alchemist::class, true]
]);
