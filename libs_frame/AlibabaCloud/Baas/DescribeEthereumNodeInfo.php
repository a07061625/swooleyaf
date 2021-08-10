<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getNodeId()
 */
class DescribeEthereumNodeInfo extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeId($value)
    {
        $this->data['NodeId'] = $value;
        $this->options['form_params']['NodeId'] = $value;

        return $this;
    }
}
