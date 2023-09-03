<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

test('ToFalse performs correctly.', function (mixed $input, bool|null $output) {
    expect(alchemy($input)->toSafeFalse())
        ->toBe($output);
})->with([
    [0, false],
    [-1, null],
    [1.0, null],
    [-3.14, null],
    ['true', null],
    ['false', null],
    [true, null],
    [false, false],
    [[], false],
    [[1, 2, 3], null],
    [['key' => 'value'], null],
    [new stdClass(), null],
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
        null
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
    [Alchemist::class, null],
]);

test('ToFalse strict mode performs correctly.', function (mixed $input, bool|TypeError $output) {
    if ($output instanceof TypeError) {
        expect(fn () => alchemy($input)->toStrictFalse())
            ->toThrow($output);
    } else {
        expect(alchemy($input)->toStrictFalse())
            ->toBe($output);
    }
})->with([
    [0, false],
    [-1, new TypeError()],
    [1.0, new TypeError()],
    [-3.14, new TypeError()],
    ['true', new TypeError()],
    ['false', new TypeError()],
    [true, new TypeError()],
    [false, false],
    [[], false],
    [[1, 2, 3], new TypeError()],
    [['key' => 'value'], new TypeError()],
    [new stdClass(), new TypeError()],
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
        new TypeError()
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
    [Alchemist::class, new TypeError()],
]);
