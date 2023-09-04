<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToNonNegativeInt performs correctly.', function (mixed $expect, int|null $result) {
    $intermediateValue = alchemy($expect)->toSafeNonNegativeInt();
    if (is_resource($expect)) {
        expect($intermediateValue)->toBeInt();   // int(371)
    } else {
        expect($intermediateValue)->toBe($result);
    }
})->with([
    [0, 0],
    [-1, null],
    [1.0, 1],
    [-3.14, null],
    ['true', 0],
    ['false', 0],
    [true, 1],
    [false, 0],
    [[], 0],
    [[1, 2, 3], 1],
    [['key' => 'value'], 1],
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
        1
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

it('ToNonNegativeInt throws specified exception correctly.', function (mixed $expect, Exception $exception) {
    expect(fn () => alchemy($expect)->toStrictNonNegativeInt($exception))
        ->toThrow($exception)
    ;
})->with([
    [-1, new LogicException()],
    [-3.14, new LogicException()],
    [new stdClass(), new LogicException()],
    [function () {return 'test';}, new RuntimeException()],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        new LogicException()
    ],
]);