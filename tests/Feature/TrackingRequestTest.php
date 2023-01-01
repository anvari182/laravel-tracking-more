<?php

use Anvari182\TrackingMore\Requests\TrackingRequest;
use Illuminate\Http\Client\PendingRequest;

use function PHPUnit\Framework\assertInstanceOf;

it('creates tracking instance', function () {
    $tracking = new TrackingRequest(
        new PendingRequest(),
        config('trackingmore.base_url'),
        config('trackingmore.api_key')
    );
    assertInstanceOf(TrackingRequest::class, $tracking);
});

it('returns api key is missing error', function () {
    $tracking = new TrackingRequest(
        new PendingRequest(),
        config('trackingmore.base_url'),
       ''
    );
})->expectExceptionMessage('API key is missing.');