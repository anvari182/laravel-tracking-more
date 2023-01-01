<?php

namespace Anvari182\TrackingMore\Data;

class TrackingData
{
    public string $tracking_number;

    public string $courier_code;

    public string $order_number = '';

    public string $customer_email = '';

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param string $tracking_number
     * @return TrackingData
     */
    public function setTrackingNumber(string $tracking_number): static
    {
        $this->tracking_number = $tracking_number;

        return $this;
    }

    /**
     * @param string $courier_code
     * @return TrackingData
     */
    public function setCourierCode(string $courier_code): static
    {
        $this->courier_code = $courier_code;

        return $this;
    }

    /**
     * @param string $order_number
     * @return TrackingData
     */
    public function setOrderNumber(string $order_number): static
    {
        $this->order_number = $order_number;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->tracking_number;
    }

    /**
     * @return string
     */
    public function getCourierCode(): string
    {
        return $this->courier_code;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->order_number;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customer_email;
    }

    /**
     * @param string $customer_email
     * @return TrackingData
     */
    public function setCustomerEmail(string $customer_email): static
    {
        $this->customer_email = $customer_email;

        return $this;
    }
}