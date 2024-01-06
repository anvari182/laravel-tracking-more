<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TrackingMore\Couriers;
use TrackingMore\Trackings;

class TrackingMoreServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/trackingmore.php', 'trackingmore');

        $apiKey = config('trackingmore.api_key');

        $this->app->bind(Tracking::class, function () use ($apiKey) {
            return new Tracking(new Trackings($apiKey));
        });

        $this->app->bind(Courier::class, function () use ($apiKey) {
            return new Courier(new Couriers($apiKey));
        });

        $this->app->bind(TrackingMore::class, function (Application $app) {
            return new TrackingMore(tracking: $app->make(Tracking::class), courier: $app->make(Courier::class));
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/trackingmore.php' => config_path('trackingmore.php'),
                ],
                'config'
            );
        }
    }
}
