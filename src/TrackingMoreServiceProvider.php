<?php

namespace Anvari182\TrackingMore;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;

class TrackingMoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/trackingmore.php', 'trackingmore');

        $this->app->bind(TrackingMore::class, function () {
            return new TrackingMore(
                new PendingRequest(),
                config('trackingmore.base_url'),
                config('trackingmore.api_key')
            );
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