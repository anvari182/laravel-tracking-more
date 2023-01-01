<?php

use Anvari182\TrackingMore\Requests\CourierRequest;
use Illuminate\Http\Client\PendingRequest;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;


it('creates courier request', function () {
    $courier = new CourierRequest(new PendingRequest(), getBaseUrl(), getApiToken());
    assertInstanceOf(CourierRequest::class, $courier);
});

it('detects courier', function () {
    $courier = new CourierRequest(new PendingRequest(), getBaseUrl(), getApiToken());
    $response = $courier->detect('9261290312833844954982');
    assertNotEmpty($response->get('data'));
});