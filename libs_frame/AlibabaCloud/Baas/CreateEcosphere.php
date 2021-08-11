<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrderersCount()
 * @method string getConsortiumName()
 * @method string getSpecName()
 * @method string getDescription()
 * @method string getChannelPolicy()
 * @method string getDuration()
 * @method array getOrganization()
 * @method string getZoneId()
 * @method string getOrdererType()
 * @method string getOrdererDomain()
 * @method string getLocation()
 * @method string getPeersCount()
 * @method string getPricingCycle()
 */
class CreateEcosphere extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderersCount($value)
    {
        $this->data['OrderersCount'] = $value;
        $this->options['form_params']['OrderersCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumName($value)
    {
        $this->data['ConsortiumName'] = $value;
        $this->options['form_params']['ConsortiumName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpecName($value)
    {
        $this->data['SpecName'] = $value;
        $this->options['form_params']['SpecName'] = $value;

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
    public function withChannelPolicy($value)
    {
        $this->data['ChannelPolicy'] = $value;
        $this->options['form_params']['ChannelPolicy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDuration($value)
    {
        $this->data['Duration'] = $value;
        $this->options['form_params']['Duration'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withOrganization(array $organization)
    {
        $this->data['Organization'] = $organization;
        foreach ($organization as $depth1 => $depth1Value) {
            $this->options['form_params']['Organization.' . ($depth1 + 1) . '.Domain'] = $depth1Value['Domain'];
            $this->options['form_params']['Organization.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['form_params']['Organization.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withZoneId($value)
    {
        $this->data['ZoneId'] = $value;
        $this->options['form_params']['ZoneId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrdererType($value)
    {
        $this->data['OrdererType'] = $value;
        $this->options['form_params']['OrdererType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrdererDomain($value)
    {
        $this->data['OrdererDomain'] = $value;
        $this->options['form_params']['OrdererDomain'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocation($value)
    {
        $this->data['Location'] = $value;
        $this->options['form_params']['Location'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPeersCount($value)
    {
        $this->data['PeersCount'] = $value;
        $this->options['form_params']['PeersCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPricingCycle($value)
    {
        $this->data['PricingCycle'] = $value;
        $this->options['form_params']['PricingCycle'] = $value;

        return $this;
    }
}
