<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getVpcAZone()
 * @method string getClientToken()
 * @method string getDbInstanceId()
 * @method string getVpcRegionId()
 * @method string getVSwitchId()
 * @method string getVpcId()
 */
class CreateDatabaseAccessPoint extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcAZone($value)
    {
        $this->data['VpcAZone'] = $value;
        $this->options['form_params']['VpcAZone'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbInstanceId($value)
    {
        $this->data['DbInstanceId'] = $value;
        $this->options['form_params']['DbInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcRegionId($value)
    {
        $this->data['VpcRegionId'] = $value;
        $this->options['form_params']['VpcRegionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVSwitchId($value)
    {
        $this->data['VSwitchId'] = $value;
        $this->options['form_params']['VSwitchId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcId($value)
    {
        $this->data['VpcId'] = $value;
        $this->options['form_params']['VpcId'] = $value;

        return $this;
    }
}
