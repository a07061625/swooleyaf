<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getCode()
 */
class AgreeAntChainInvitation extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCode($value)
    {
        $this->data['Code'] = $value;
        $this->options['form_params']['Code'] = $value;

        return $this;
    }
}
