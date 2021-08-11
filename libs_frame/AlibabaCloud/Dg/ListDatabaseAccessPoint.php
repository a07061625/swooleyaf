<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getSearchKey()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getHost()
 * @method string getDbInstanceId()
 * @method string getGatewayId()
 * @method string getPort()
 * @method string getVpcId()
 */
class ListDatabaseAccessPoint extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSearchKey($value)
    {
        $this->data['SearchKey'] = $value;
        $this->options['form_params']['SearchKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHost($value)
    {
        $this->data['Host'] = $value;
        $this->options['form_params']['Host'] = $value;

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
    public function withGatewayId($value)
    {
        $this->data['GatewayId'] = $value;
        $this->options['form_params']['GatewayId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPort($value)
    {
        $this->data['Port'] = $value;
        $this->options['form_params']['Port'] = $value;

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
