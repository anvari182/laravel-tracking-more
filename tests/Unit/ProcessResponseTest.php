<?php

use Anvari182\TrackingMore\Concerns\ProcessResponse;

use function PHPUnit\Framework\assertNotTrue;
use function PHPUnit\Framework\assertTrue;

it('return false when code is not 200', function () {
    $class = new class {
        use ProcessResponse;
    };

    assertNotTrue($class->isSuccessful('401'));
});

it('return true when code is 200', function () {
    $class = new class {
        use ProcessResponse;
    };

    assertTrue($class->isSuccessful('200'));
});