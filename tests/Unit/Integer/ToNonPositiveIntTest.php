<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToNonPositiveInt performs correctly.', function (mixed $expect, int|null $result) {
    $intermediateValue = alchemy($expect)->toSafeNonPositiveInt();
    expect($intermediateValue)
        //->dump();
        ->toBe($result);
})->with([
    [0, 0],
    [-1, -1],
    [1.0, null],
    [-3.14, -3],
    ['true', 0],
    ['false', 0],
    [true, null],
    [false, 0],
    [[], 0],
    [[1, 2, 3], null],
    [['key' => 'value'], null],
    [new stdClass(), null],
    [null, 0],
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

it('ToNonPositiveInt throws TypeError correctly.', function (mixed $expect, int|TypeError $result) {
    if ($result instanceof TypeError) {
        expect(fn () => alchemy($expect)->toStrictNonPositiveInt())
            ->toThrow($result);
    } else {
        expect(alchemy($expect)->toStrictNonPositiveInt())
            ->toBe($result);
    }
})->with([
    [0, 0],
    [-1, -1],
    [1.0, new TypeError()],
    [-3.14, -3],
    ['true', 0],
    ['false', 0],
    [true, new TypeError()],
    [false, 0],
    [[], 0],
    [[1, 2, 3], new TypeError()],
    [['key' => 'value'], new TypeError()],
    [new stdClass(), new TypeError()],
    [null, 0],
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

it('ToNonPositiveInt throws specified exception correctly.', function (mixed $expect, Exception $exception) {
    expect(fn () => alchemy($expect)->toStrictNonPositiveInt($exception))
        ->toThrow($exception);
})->with([
    [1.0, new LogicException()],
    [true, new LogicException()],
    [[1, 2, 3], new LogicException()],
    [['key' => 'value'], new RuntimeException()],
    [new stdClass(), new RuntimeException()],
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
        new RuntimeException()
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