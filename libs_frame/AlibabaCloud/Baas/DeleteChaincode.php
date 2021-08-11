<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getChaincodeId()
 */
class DeleteChaincode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChaincodeId($value)
    {
        $this->data['ChaincodeId'] = $value;
        $this->options['form_params']['ChaincodeId'] = $value;

        return $this;
    }
}
