<?php

namespace Anvari182\TrackingMore\Requests;

use Illuminate\Http\Client\PendingRequest;

abstract class BaseRequest
{
    /**
     * @param PendingRequest $client
     * @param string $baseUrl
     * @param string $apiKey
     */
    public function __construct(
        protected PendingRequest $client,
        protected string $baseUrl,
        protected string $apiKey
    ) {
        if (empty($this->baseUrl)) {
            throw new \InvalidArgumentException('Base URL is missing.');
        }

        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('API key is missing.');
        }

        $this->client->baseUrl($this->baseUrl);

        $this->client->withHeaders(['Tracking-Api-Key' => $this->apiKey]);
    }

    /**
     * @return PendingRequest
     */
    public function getClient(): PendingRequest
    {
        return $this->client;
    }
}