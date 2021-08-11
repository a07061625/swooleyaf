<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getLimit()
 * @method $this withLimit($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDevice()
 * @method $this withDevice($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListTask extends Rpc
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
