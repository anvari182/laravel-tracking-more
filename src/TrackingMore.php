<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Exceptions\MissingArgumentException;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;

class TrackingMore
{
    protected const COURIER_PATH = 'couriers';

    protected const TRACKING_PATH = 'trackings';

    /**
     * @throws MissingArgumentException
     */
    public function __construct(
        protected PendingRequest $client,
        protected string $baseUrl,
        protected string $apiKey
    ) {
        if (empty($this->baseUrl)) {
            throw new MissingArgumentException('Base URL is missing.');
        }

        if (empty($this->apiKey)) {
            throw new MissingArgumentException('API key is missing.');
        }

        $this->client->baseUrl($this->baseUrl);

        $this->client->withHeaders(['Tracking-Api-Key' => $this->apiKey]);
    }

    /**
     * @throws Exception
     */
    public function getAllCourier(): Collection
    {
        $response = $this->client->get(self::COURIER_PATH . '/all');

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        return $response->collect();
    }

    /**
     * @throws Exception
     */
    public function detect(string $trackingNumber): Collection
    {
        $response = $this->client->post(self::COURIER_PATH . '/detect', ['tracking_number' => $trackingNumber]);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        return $response->collect();
    }

}