<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getPublicKey()
 * @method string getKeyType()
 * @method string getLedgerId()
 */
class AcceptMember extends Rpc
{
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
    public function withKeyType($value)
    {
        $this->data['KeyType'] = $value;
        $this->options['form_params']['KeyType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLedgerId($value)
    {
        $this->data['LedgerId'] = $value;
        $this->options['form_params']['LedgerId'] = $value;

        return $this;
    }
}
