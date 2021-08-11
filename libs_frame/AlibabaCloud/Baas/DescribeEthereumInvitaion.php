<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getToken()
 */
class DescribeEthereumInvitaion extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToken($value)
    {
        $this->data['Token'] = $value;
        $this->options['form_params']['Token'] = $value;

        return $this;
    }
}
