<?php

namespace AlibabaCloud\Dg;

/**
 * @method string getClientToken()
 * @method string getHost()
 * @method string getDbUserName()
 * @method string getDbDescription()
 * @method string getGatewayId()
 * @method string getDbName()
 * @method string getPort()
 * @method string getDbPassword()
 * @method string getDbType()
 */
class AddDatabase extends Rpc
{
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
    public function withDbUserName($value)
    {
        $this->data['DbUserName'] = $value;
        $this->options['form_params']['DbUserName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbDescription($value)
    {
        $this->data['DbDescription'] = $value;
        $this->options['form_params']['DbDescription'] = $value;

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
    public function withDbName($value)
    {
        $this->data['DbName'] = $value;
        $this->options['form_params']['DbName'] = $value;

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
    public function withDbPassword($value)
    {
        $this->data['DbPassword'] = $value;
        $this->options['form_params']['DbPassword'] = $value;

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
