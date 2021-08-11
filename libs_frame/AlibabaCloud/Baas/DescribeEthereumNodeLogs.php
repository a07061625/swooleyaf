<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getLines()
 * @method string getNodeId()
 * @method string getTarget()
 */
class DescribeEthereumNodeLogs extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLines($value)
    {
        $this->data['Lines'] = $value;
        $this->options['form_params']['Lines'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTarget($value)
    {
        $this->data['Target'] = $value;
        $this->options['form_params']['Target'] = $value;

        return $this;
    }
}
