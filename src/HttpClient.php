<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Exceptions\MissingArgumentException;
use Illuminate\Http\Client\PendingRequest;

class HttpClient
{
    /**
     * @throws MissingArgumentException
     */
    public function __construct(private PendingRequest $pendingRequest, private string $baseUrl, private string $apiKey)
    {
        if (empty($this->baseUrl)) {
            throw new MissingArgumentException('Base URL is missing.');
        }

        if (empty($this->apiKey)) {
            throw new MissingArgumentException('API key is missing.');
        }

        $this->pendingRequest->baseUrl($this->baseUrl);

        $this->pendingRequest->withHeaders(['Tracking-Api-Key' => $this->apiKey]);
    }

    /**
     * @return PendingRequest
     */
    public function request(): PendingRequest
    {
        return $this->pendingRequest;
    }
}
