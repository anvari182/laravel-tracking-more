<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;

class TrackingMoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/trackingmore.php', 'trackingmore');

        $httpClient = new HttpClient(
            pendingRequest: new PendingRequest(),
            baseUrl:        config('trackingmore.base_url'),
            apiKey:         config('trackingmore.api_key')
        );

        $this->app->bind(Tracking::class, function () use ($httpClient) {
            return new Tracking($httpClient);
        });

        $this->app->bind(Courier::class, function () use ($httpClient) {
            return new Courier($httpClient);
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
                    __DIR__.'/../config/trackingmore.php' => config_path('trackingmore.php'),
                ],
                'config'
            );
        }
    }
}
