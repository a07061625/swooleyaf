<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getAccountPubKey()
 * @method string getBizid()
 * @method string getAccount()
 * @method string getAccountRecoverPubKey()
 */
class CreatePublicAntChainAccount extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountPubKey($value)
    {
        $this->data['AccountPubKey'] = $value;
        $this->options['form_params']['AccountPubKey'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountRecoverPubKey($value)
    {
        $this->data['AccountRecoverPubKey'] = $value;
        $this->options['form_params']['AccountRecoverPubKey'] = $value;

        return $this;
    }
}
