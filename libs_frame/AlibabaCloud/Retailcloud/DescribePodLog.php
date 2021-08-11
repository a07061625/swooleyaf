<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getDeployOrderId()
 * @method string getAppInstId()
 */
class DescribePodLog extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeployOrderId($value)
    {
        $this->data['DeployOrderId'] = $value;
        $this->options['form_params']['DeployOrderId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppInstId($value)
    {
        $this->data['AppInstId'] = $value;
        $this->options['form_params']['AppInstId'] = $value;

        return $this;
    }
}
