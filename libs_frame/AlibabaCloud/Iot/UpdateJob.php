<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getRolloutConfig()
 * @method $this withRolloutConfig($value)
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getTimeoutConfig()
 * @method $this withTimeoutConfig($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class UpdateJob extends Rpc
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
