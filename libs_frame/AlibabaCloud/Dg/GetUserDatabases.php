<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getSearchKey()
 * @method string getPageNumber()
 * @method string getPageSize()
 * @method string getHost()
 * @method string getGatewayId()
 * @method string getInstanceId()
 * @method string getPort()
 * @method string getDbType()
 */
class GetUserDatabases extends Rpc
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
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

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
    public function withDbType($value)
    {
        $this->data['DbType'] = $value;
        $this->options['form_params']['DbType'] = $value;

        return $this;
    }
}
