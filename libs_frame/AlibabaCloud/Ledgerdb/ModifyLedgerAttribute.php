<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getLedgerId()
 * @method string getLedgerName()
 * @method string getLedgerDescription()
 */
class ModifyLedgerAttribute extends Rpc
{
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
    public function withLedgerName($value)
    {
        $this->data['LedgerName'] = $value;
        $this->options['form_params']['LedgerName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLedgerDescription($value)
    {
        $this->data['LedgerDescription'] = $value;
        $this->options['form_params']['LedgerDescription'] = $value;

        return $this;
    }
}
