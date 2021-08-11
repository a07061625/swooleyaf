<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getEthereumId()
 */
class DescribeEthereumDeletable extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEthereumId($value)
    {
        $this->data['EthereumId'] = $value;
        $this->options['form_params']['EthereumId'] = $value;

        return $this;
    }
}
