<?php

use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Illuminate\Support\Facades\File;

it('detects a courier', function () {
    $courier = mock(Courier::class);
    $courier->shouldReceive('detectCourier')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/courierDetectResponse.json'), true));
    TrackingMore::shouldReceive('courier')->andReturn($courier);
    $result = TrackingMore::courier()->detectCourier('XYZ124');
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    ;
});

it('gets all courier', function () {
    $courier = mock(Courier::class);
    $courier->shouldReceive('getAll')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/allCourierResponse.json'), true));
    TrackingMore::shouldReceive('courier')->andReturn($courier);
    $result = TrackingMore::courier()->getAll();
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    expect($result['data'][0]['courier_code'])->toBe('tuffnells');
});
