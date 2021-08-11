<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getK8sClusterId()
 */
class DescribeGuestClusterAccessLogDashboards extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withK8sClusterId($value)
    {
        $this->data['K8sClusterId'] = $value;
        $this->options['form_params']['K8sClusterId'] = $value;

        return $this;
    }
}
