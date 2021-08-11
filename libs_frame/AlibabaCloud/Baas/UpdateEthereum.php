<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getName()
 * @method string getEthereumId()
 * @method string getDescription()
 */
class UpdateEthereum extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

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
}
