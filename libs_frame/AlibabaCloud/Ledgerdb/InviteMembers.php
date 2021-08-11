<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getAliUids()
 * @method string getLedgerId()
 */
class InviteMembers extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAliUids($value)
    {
        $this->data['AliUids'] = $value;
        $this->options['form_params']['AliUids'] = $value;

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
