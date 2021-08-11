<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getNick()
 * @method string getInstanceId()
 * @method string getAppKey()
 * @method string getUserId()
 */
class GetUserToken extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNick($value)
    {
        $this->data['Nick'] = $value;
        $this->options['form_params']['Nick'] = $value;

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
    public function withAppKey($value)
    {
        $this->data['AppKey'] = $value;
        $this->options['form_params']['AppKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }
}
