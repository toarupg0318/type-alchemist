<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToNegativeIntTrait performs correctly.', function (mixed $expect, int|null $result) {
    $intermediateValue = alchemy($expect)->toSafeNegativeInt();
    expect($intermediateValue)->toBe($result);
})->with([
    [0, null],
    [-1, -1],
    [1.0, null],
    [-3.14, -3],
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
]);

it('ToNegativeIntTrait throws TypeError correctly.', function (mixed $expect, int|TypeError $result) {
    if ($result instanceof TypeError) {
        expect(fn () => alchemy($expect)->toStrictNegativeInt())
            ->toThrow($result);
    } else {
        expect(alchemy($expect)->toStrictNegativeInt())
            ->toBe($result);
    }
})->with([
    [0, new TypeError()],
    [-1, -1],
    [1.0, new TypeError()],
    [-3.14, -3],
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
]);

it('ToNegativeIntTrait throws specified exception correctly.', function (mixed $expect, Exception $exception) {
    expect(fn () => alchemy($expect)->toStrictNegativeInt($exception))
        ->toThrow($exception);
})->with([
    [0, new LogicException()],
    [1.0, new RuntimeException()],
    ['true', new LogicException()],
    ['false', new RuntimeException()],
    [true, new LogicException()],
    [false, new RuntimeException()],
    [[], new LogicException()],
    [[1, 2, 3], new RuntimeException()],
    [['key' => 'value'], new LogicException()],
    [new stdClass(), new RuntimeException()],
    [null, new LogicException()],
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
        new LogicException()
    ],
    [function () {return 'test';}, new RuntimeException()],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        new RuntimeException()
    ],
]);