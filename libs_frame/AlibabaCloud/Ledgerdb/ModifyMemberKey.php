<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getPublicKey()
 * @method string getKeyType()
 * @method string getLedgerId()
 * @method string getMemberId()
 */
class ModifyMemberKey extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemberId($value)
    {
        $this->data['MemberId'] = $value;
        $this->options['form_params']['MemberId'] = $value;

        return $this;
    }
}
