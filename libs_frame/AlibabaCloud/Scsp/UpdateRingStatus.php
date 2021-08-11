<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getExtra()
 * @method string getCallOutStatus()
 * @method string getUniqueBizId()
 */
class UpdateRingStatus extends Rpc
{
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
    public function withExtra($value)
    {
        $this->data['Extra'] = $value;
        $this->options['form_params']['Extra'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallOutStatus($value)
    {
        $this->data['CallOutStatus'] = $value;
        $this->options['form_params']['CallOutStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUniqueBizId($value)
    {
        $this->data['UniqueBizId'] = $value;
        $this->options['form_params']['UniqueBizId'] = $value;

        return $this;
    }
}
