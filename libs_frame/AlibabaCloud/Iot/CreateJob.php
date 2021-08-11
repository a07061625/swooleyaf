<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getJobDocument()
 * @method $this withJobDocument($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getRolloutConfig()
 * @method $this withRolloutConfig($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getJobName()
 * @method $this withJobName($value)
 * @method string getTimeoutConfig()
 * @method $this withTimeoutConfig($value)
 * @method string getTargetConfig()
 * @method $this withTargetConfig($value)
 * @method string getJobFile()
 * @method $this withJobFile($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getScheduledTime()
 * @method $this withScheduledTime($value)
 */
class CreateJob extends Rpc
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
