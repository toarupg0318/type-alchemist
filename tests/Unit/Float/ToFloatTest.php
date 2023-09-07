<?php

declare(strict_types=1);

use function Toarupg0318\TypeAlchemist\alchemy;

test('ToFloat performs correctly.', function (mixed $input, float|null $output) {
    if (is_resource($input)) {
        expect(alchemy($input)->toSafeFloat())
            ->toBeFloat();
    } else {
        expect(alchemy($input)->toSafeFloat())
            ->toBe($output);
    }
})->with([
    [0, 0.0],
    [-1, -1.0],
    [1.0, 1.0],
    [-3.14, -3.14],
    ['true', 0.0],
    ['false', 0.0],
    [true, 1.0],
    [false, 0.0],
    [[], 0.0],
    [[1, 2, 3], 1.0],
    [['key' => 'value'], 1.0],
    [new stdClass(), null],
    [null, 0.0],
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
        null    // like 382.0
    ],
    [function () {return 'test';}, null],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        null
    ],
]);

test('ToFloat strict mode performs correctly.', function (mixed $input, float|TypeError $output) {
    if ($output instanceof TypeError) {
        expect(fn () => alchemy($input)->toStrictFloat())
            ->toThrow($output);
    } else {
        if (is_resource($input)) {
            expect(alchemy($input)->toSafeFloat())
                ->toBeFloat();
        } else {
            expect(alchemy($input)->toSafeFloat())
                ->toBe($output);
        }
    }
})->with([
    [0, 0.0],
    [-1, -1.0],
    [1.0, 1.0],
    [-3.14, -3.14],
    ['true', 0.0],
    ['false', 0.0],
    [true, 1.0],
    [false, 0.0],
    [[], 0.0],
    [[1, 2, 3], 1.0],
    [['key' => 'value'], 1.0],
    [new stdClass(), new TypeError()],
    [null, 0.0],
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
        382    // like 382.0
    ],
    [function () {return 'test';}, new TypeError()],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        new TypeError()
    ],
]);