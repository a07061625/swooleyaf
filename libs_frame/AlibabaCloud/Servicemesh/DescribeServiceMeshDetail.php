<?php

namespace AlibabaCloud\Servicemesh;

/**
 * @method string getServiceMeshId()
 */
class DescribeServiceMeshDetail extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceMeshId($value)
    {
        $this->data['ServiceMeshId'] = $value;
        $this->options['form_params']['ServiceMeshId'] = $value;

        return $this;
    }
}
