<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getCity()
 * @method string getLatitude()
 * @method string getDescription()
 * @method string getAddressCode()
 * @method string getGisCoordinateSystem()
 * @method string getLongitude()
 * @method string getAddress()
 * @method string getGwEui()
 * @method string getFreqBandPlanGroupId()
 * @method string getDistrict()
 * @method string getName()
 * @method string getCommunicationMode()
 */
class UpdateGateway extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCity($value)
    {
        $this->data['City'] = $value;
        $this->options['form_params']['City'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLatitude($value)
    {
        $this->data['Latitude'] = $value;
        $this->options['form_params']['Latitude'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddressCode($value)
    {
        $this->data['AddressCode'] = $value;
        $this->options['form_params']['AddressCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGisCoordinateSystem($value)
    {
        $this->data['GisCoordinateSystem'] = $value;
        $this->options['form_params']['GisCoordinateSystem'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLongitude($value)
    {
        $this->data['Longitude'] = $value;
        $this->options['form_params']['Longitude'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddress($value)
    {
        $this->data['Address'] = $value;
        $this->options['form_params']['Address'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGwEui($value)
    {
        $this->data['GwEui'] = $value;
        $this->options['form_params']['GwEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFreqBandPlanGroupId($value)
    {
        $this->data['FreqBandPlanGroupId'] = $value;
        $this->options['form_params']['FreqBandPlanGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDistrict($value)
    {
        $this->data['District'] = $value;
        $this->options['form_params']['District'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommunicationMode($value)
    {
        $this->data['CommunicationMode'] = $value;
        $this->options['form_params']['CommunicationMode'] = $value;

        return $this;
    }
}
