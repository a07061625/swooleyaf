<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getNodeName()
 * @method string getEthereumId()
 * @method string getDescription()
 * @method string getExternalNode()
 */
class AddEthereumNode extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeName($value)
    {
        $this->data['NodeName'] = $value;
        $this->options['form_params']['NodeName'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExternalNode($value)
    {
        $this->data['ExternalNode'] = $value;
        $this->options['form_params']['ExternalNode'] = $value;

        return $this;
    }
}
