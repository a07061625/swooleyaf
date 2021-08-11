<?php

namespace AlibabaCloud\Openanalytics;

/**
 * @method string getProductCode()
 * @method string getProductAccessKey()
 * @method string getTargetUid()
 * @method string getTargetArnRole()
 */
class GetProductStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductCode($value)
    {
        $this->data['ProductCode'] = $value;
        $this->options['form_params']['ProductCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductAccessKey($value)
    {
        $this->data['ProductAccessKey'] = $value;
        $this->options['form_params']['ProductAccessKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUid($value)
    {
        $this->data['TargetUid'] = $value;
        $this->options['form_params']['TargetUid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetArnRole($value)
    {
        $this->data['TargetArnRole'] = $value;
        $this->options['form_params']['TargetArnRole'] = $value;

        return $this;
    }
}
