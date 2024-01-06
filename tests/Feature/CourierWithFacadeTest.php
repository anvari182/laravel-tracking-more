<?php

use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Illuminate\Support\Facades\File;

it('detects a courier', function () {
    $courier = mock(Courier::class);
    $courier->shouldReceive('detect')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/courierDetectResponse.json'), true));
    TrackingMore::shouldReceive('courier')->andReturn($courier);
    $result = TrackingMore::courier()->detect('XYZ124');
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    ;
});

it('gets all courier', function () {
    $courier = mock(Courier::class);
    $courier->shouldReceive('getAllCouriers')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/allCourierResponse.json'), true));
    TrackingMore::shouldReceive('courier')->andReturn($courier);
    $result = TrackingMore::courier()->getAllCouriers();
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    expect($result['data'][0]['courier_code'])->toBe('tuffnells');
});
