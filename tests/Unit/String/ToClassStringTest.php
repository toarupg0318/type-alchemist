<?php

use Toarupg0318\TypeAlchemist\Alchemist;
use function Toarupg0318\TypeAlchemist\alchemy;

it('ToSafeClassString feature performs correctly.', function (mixed $expect, string|null $result) {
    /**
     * @param mixed $expect
     * @param string|null $result
     */

    $convertedValue = alchemy($expect)->toSafeClassString(Alchemist::class);
    expect($convertedValue)->toBe($result);
})->with([
    [0, null],
    [-1, null],
    [1.0, null],
    [-3.14, null],
    ['true', null],
    ['false', null],
    [true, null],
    [false, null],
    [[], null],
    [[1, 2, 3], null],
    [['key' => 'value'], null],
    [new stdClass(), null],
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
    [Alchemist::class, Alchemist::class]
]);

it('ToSafeClassString feature throw TypeError correctly.', function (mixed $expect, string|TypeError $result) {
    /**
     * @param mixed $expect
     * @param class-string<Alchemist>|TypeError $result
     */

    $convertedValue = alchemy($expect)->toSafeClassString(Alchemist::class);
    if ($result instanceof TypeError) {
        expect(fn () => alchemy($convertedValue)->toStrictClassString(Alchemist::class))
            ->toThrow($result);
    } else {
        expect(alchemy($convertedValue)->toStrictClassString(Alchemist::class))
            ->toBe($result);
    }
})->with([
    [0, new TypeError()],
    [-1, new TypeError()],
    [1.0, new TypeError()],
    [-3.14, new TypeError()],
    ['true', new TypeError()],
    ['false', new TypeError()],
    [true, new TypeError()],
    [false, new TypeError()],
    [[], new TypeError()],
    [[1, 2, 3], new TypeError()],
    [['key' => 'value'], new TypeError()],
    [new stdClass(), new TypeError()],
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
    [Alchemist::class, Alchemist::class]
]);
