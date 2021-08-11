<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getOrderId()
 * @method string getUserOssBucket()
 * @method string getDisplayName()
 * @method string getUserVpcId()
 * @method string getZoneId()
 * @method string getDescription()
 * @method string getUserVSwitch()
 */
class CreateCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/clusters';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrderId($value)
    {
        $this->data['OrderId'] = $value;
        $this->options['form_params']['orderId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserOssBucket($value)
    {
        $this->data['UserOssBucket'] = $value;
        $this->options['form_params']['userOssBucket'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDisplayName($value)
    {
        $this->data['DisplayName'] = $value;
        $this->options['form_params']['displayName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserVpcId($value)
    {
        $this->data['UserVpcId'] = $value;
        $this->options['form_params']['userVpcId'] = $value;

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
        $this->options['form_params']['zoneId'] = $value;

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
        $this->options['form_params']['description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserVSwitch($value)
    {
        $this->data['UserVSwitch'] = $value;
        $this->options['form_params']['userVSwitch'] = $value;

        return $this;
    }
}
