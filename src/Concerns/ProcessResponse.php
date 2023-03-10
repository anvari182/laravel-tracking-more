<?php

namespace Anvari182\TrackingMore\Concerns;

use Anvari182\TrackingMore\Exceptions\EmptyResponseException;
use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

trait ProcessResponse
{
    /**
     * @param  string|null  $code
     * @return bool
     */
    public function isSuccessful(?string $code): bool
    {
        if (is_null($code)) {
            return false;
        }

        if ($code !== '200') {
            return false;
        }

        return true;
    }

    /**
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function processMeta(Response $response): void
    {
        $meta = $response->collect('meta');

        if ($meta->isEmpty()) {
            throw new EmptyResponseException();
        }

        if (! $this->isSuccessful($meta->get('code'))) {
            throw new Exception($meta['message'] ?? 'TrackingMore request failed.');
        }
    }

    public function getResponseData(Response $response, string $key = 'data'): array
    {
        $data = $response->collect($key);

        if ($data->isEmpty()) {
            return [];
        }

        return $data->toArray();
    }

    /**
     * @throws RequestException
     * @throws EmptyResponseException
     */
    public function processResponse(Response|PromiseInterface $response): array
    {
        if ($response->failed()) {
            $response->throw();
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }
}
