<?php

namespace Anvari182\TrackingMore\Requests;

use Exception;
use Illuminate\Support\Collection;

class CourierRequest extends BaseRequest
{
    private const BASE_PATH = 'couriers';

    private const GET_ALL = 'all';

    private const DETECT = 'detect';

    /**
     * @throws Exception
     */
    public function getAll(): Collection
    {
        $response = $this->client->get(self::BASE_PATH . '/' . self::GET_ALL);

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
        $response = $this->client->post(self::BASE_PATH . '/' . self::DETECT, ['tracking_number' => $trackingNumber]);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        return $response->collect();
    }
}