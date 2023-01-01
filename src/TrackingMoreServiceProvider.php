<?php

namespace Anvari182\TrackingMore;

use Illuminate\Support\ServiceProvider;

class TrackingMoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/trackingmore.php', 'trackingmore');

        $this->app->bind('TrackingMore', function () {
            return new TrackingMore(new Factory());
        });
    }

    public function boot()
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