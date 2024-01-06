<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use TrackingMore\Interfaces\TrackingsInterface;
use Trackingmore\TrackingMoreException;
use TrackingMore\Trackings;

class Tracking implements TrackingsInterface
{
    public function __construct(private Trackings $trackings)
    {
    }

    /**
     * @throws TrackingMoreException
     */
    public function createTracking($params = []): array
    {
        return $this->trackings->createTracking($params);
    }

    public function getTrackingResults($params = []): array
    {
        return $this->trackings->getTrackingResults();
    }

    /**
     * @throws TrackingMoreException
     */
    public function batchCreateTrackings($params = []): array
    {
        return $this->trackings->batchCreateTrackings($params);
    }

    /**
     * @throws TrackingMoreException
     */
    public function updateTrackingByID($idString = '', $params = []): array
    {
        return $this->trackings->updateTrackingByID($idString, $params);
    }

    /**
     * @throws TrackingMoreException
     */
    public function deleteTrackingByID($idString = ''): array
    {
        return $this->trackings->deleteTrackingByID($idString);
    }

    /**
     * @throws TrackingMoreException
     */
    public function retrackTrackingByID($idString = ''): array
    {
        return $this->trackings->retrackTrackingByID($idString);
    }
}
