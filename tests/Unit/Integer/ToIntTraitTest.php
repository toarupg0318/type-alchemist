<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToIntTrait performs correctly.', function (mixed $expect, int|null $result) {
    $intermediateValue = alchemy($expect)->toSafeInt();
    if (is_resource($expect)) {
        expect($intermediateValue)->toBeInt();   // int(371)
    } else {
        expect($intermediateValue)->toBe($result);
    }
})->with([
    [0, 0],
    [-1, -1],
    [1.0, 1],
    [-3.14, -3],
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

it(
    description: 'tests strict mode throws TypeError correctly.',
    closure: function (
        mixed $input,
        int|TypeError|null $output
    ) {
        if ($output instanceof Throwable) {
            expect(fn () => alchemy($input)
                ->toStrictInt())->toThrow($output);
        } else {
            if (is_resource($input)) {
                expect(alchemy($input)
                    ->toStrictInt())
                    ->toBeInt($output);
            } else {
                expect(alchemy($input)->toStrictInt())
                    ->toBe($output);
            }
        }
    }
)
    ->with([
        [0, 0],
        [-1, -1],
        [1.0, 1],
        [-3.14, -3],
        ['true', 0],
        ['false', 0],
        [true, 1],
        [false, 0],
        [[], 0],
        [[1, 2, 3], 1],
        [['key' => 'value'], 1],
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
            PHP_INT_MAX
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