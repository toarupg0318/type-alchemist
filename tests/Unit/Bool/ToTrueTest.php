<?php

declare(strict_types=1);

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

test('ToTrue performs correctly.', function (mixed $input, bool|null $output) {
    expect(alchemy($input)->toSafeTrue())
        ->toBe($output);
})->with([
    [0, null],
    [-1, true],
    [1.0, true],
    [-3.14, true],
    ['true', true],
    ['false', true],
    [true, true],
    [false, null],
    [[], null],
    [[1, 2, 3], true],
    [['key' => 'value'], true],
    [new stdClass(), true],
    [null, null],
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
    [Alchemist::class, true],
]);

test('ToTrue strict mode performs correctly.', function (mixed $input, bool|TypeError $output) {
    if ($output instanceof TypeError) {
        expect(fn () => alchemy($input)->toStrictTrue())
            ->toThrow($output);
    } else {
        expect(alchemy($input)->toStrictTrue())
            ->toBe($output);
    }
})->with([
    [0, new TypeError()],
    [-1, true],
    [1.0, true],
    [-3.14, true],
    ['true', true],
    ['false', true],
    [true, true],
    [false, new TypeError()],
    [[], new TypeError()],
    [[1, 2, 3], true],
    [['key' => 'value'], true],
    [new stdClass(), true],
    [null, new TypeError()],
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
    [Alchemist::class, true],
]);
