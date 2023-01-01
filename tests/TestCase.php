<?php

namespace Anvari182\TrackingMore\Tests;

use Anvari182\TrackingMore\TrackingMoreServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $enablesPackageDiscoveries = true;

    protected $loadEnvironmentVariables = true;

    protected function getPackageProviders($app): array
    {
        return [
            TrackingMoreServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'TrackingMore' => 'Anvari182\TrackingMore\Facades\TrackingMore'
        ];
    }

}