<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToNonZeroInt performs correctly.', function (mixed $input, int|null $result) {
    if (is_resource($input)) {
        $intermediateValue = alchemy($input)->toSafeNonZeroInt();
        expect($intermediateValue)->toBeInt($intermediateValue);
    } else {
        $intermediateValue = alchemy($input)->toSafeNonZeroInt();
        expect($intermediateValue)->toBe($result);
    }
})->with([
    [0, null],
    [-1, -1],
    [1.0, 1],
    [-3.14, -3],
    ['true', null],
    ['false', null],
    [true, 1],
    [false, null],
    [[], null],
    [[1, 2, 3], 1],
    [['key' => 'value'], 1],
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

it('ToNonZeroInt throws TypeError correctly.', function (mixed $input, int|TypeError $output) {
    if ($output instanceof TypeError) {
        expect(fn () => alchemy($input)->toStrictNonZeroInt())
            ->toThrow($output);
    } else {
        if (is_resource($input)) {
            $intermediateValue = alchemy($input)->toSafeNonZeroInt();
            expect($intermediateValue)->toBeInt($intermediateValue);
        } else {
            $intermediateValue = alchemy($input)->toSafeNonZeroInt();
            expect($intermediateValue)->toBe($output);
        }
    }
})->with([
    [0, new TypeError()],
    [-1, -1],
    [1.0, 1],
    [-3.14, -3],
    ['true', new TypeError()],
    ['false', new TypeError()],
    [true, 1],
    [false, new TypeError()],
    [[], new TypeError()],
    [[1, 2, 3], 1],
    [['key' => 'value'], 1],
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
        1
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
