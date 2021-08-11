<?php

namespace AlibabaCloud\Ledgerdb;

/**
 * @method string getRole()
 * @method string getLedgerId()
 * @method string getMemberId()
 */
class ModifyMemberACLs extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRole($value)
    {
        $this->data['Role'] = $value;
        $this->options['form_params']['Role'] = $value;

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
