<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getIdentity()
 * @method string getBizid()
 * @method string getPublicKey()
 * @method string getRecoveryKey()
 */
class CreateOwnAccount extends Rpc
{
    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIdentity($value)
    {
        $this->data['Identity'] = $value;
        $this->options['form_params']['Identity'] = $value;

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
    public function withPublicKey($value)
    {
        $this->data['PublicKey'] = $value;
        $this->options['form_params']['PublicKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRecoveryKey($value)
    {
        $this->data['RecoveryKey'] = $value;
        $this->options['form_params']['RecoveryKey'] = $value;

        return $this;
    }
}
