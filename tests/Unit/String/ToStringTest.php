<?php

use function Toarupg0318\TypeAlchemist\alchemy;

it('ToStringTrait performs correctly.', function (mixed $expect, string|null $result) {
    $intermediateValue = alchemy($expect)->toSafeString();
    if (is_resource($expect)) {
        expect($intermediateValue)->toBeString();   // resource(420) of type (stream)
    } else {
        expect($intermediateValue)->toBe($result);
    }
})->with([
    [0, '0'],
    [-1, '-1'],
    [1.0, '1'],
    [-3.14, '-3.14'],
    ['true', 'true'],
    ['false', 'false'],
    [true, '1'],
    //[false, ''],
    //[false, null],
    [[], null],
    [[1, 2, 3], null],
    [['key' => 'value'], null],
    [new stdClass(), null],
    [null, ''],
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
        ''
    ],
    [function () {return 'test';}, null],
    [
        new class () implements Stringable {
            public function __toString(): string
            {
                return 'hoge';
            }
        },
        'hoge'
    ],
]);

it(
    description: 'tests strict mode throws TypeError correctly.',
    closure: function (
        mixed $input,
        string|TypeError $output
    ) {
        if ($output instanceof Throwable) {
            expect(fn () => alchemy($input)->toStrictString())
                ->toThrow($output);
        } else {
            if (is_resource($input)) {
                expect(alchemy($input)->toStrictString())
                    ->toBeString($output);
            } else {
                expect(alchemy($input)->toStrictString())
                    ->toBe($output);
            }
        }
    }
)
    ->with([
        [0, '0'],
        [-1, '-1'],
        [1.0, '1'],
        [-3.14, '-3.14'],
        ['true', 'true'],
        ['false', 'false'],
        [true, '1'],
        //[false, ''],
        //[false, null],
        [[], new TypeError()],
        [[1, 2, 3], new TypeError()],
        [['key' => 'value'], new TypeError()],
        [new stdClass(), new TypeError()],
        [null, ''],
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
            ''
        ],
        [function () {return 'test';}, new TypeError()],
        [
            new class () implements Stringable {
                public function __toString(): string
                {
                    return 'hoge';
                }
            },
            'hoge'
        ],
    ]);

it(
    description: 'tests strict mode throws specified Exception correctly.',
    closure: function (
        mixed $input,
        Exception $exception
    ) {
        expect(fn () => alchemy($input)->toStrictString($exception))
            ->toThrow($exception);
    }
)
    ->with([
        [[], new Exception()],
        [[1, 2, 3], new LogicException()],
        [['key' => 'value'], new RuntimeException()],
        [new stdClass(), new Exception()],
        [function () {return 'test';}, new LogicException()],
    ]);