<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getTimeout()
 * @method $this withTimeout($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getRequestBase64Byte()
 * @method $this withRequestBase64Byte($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getTopic()
 * @method $this withTopic($value)
 * @method string getApiRevision()
 * @method string getDeviceName()
 * @method $this withDeviceName($value)
 */
class RRpc extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
