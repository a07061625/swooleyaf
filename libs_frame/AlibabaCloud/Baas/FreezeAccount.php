<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getBizid()
 * @method string getAccount()
 */
class FreezeAccount extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccount($value)
    {
        $this->data['Account'] = $value;
        $this->options['form_params']['Account'] = $value;

        return $this;
    }
}
