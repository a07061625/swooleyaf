<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAccountPassword()
 * @method string getAccountName()
 * @method string getDbInstanceId()
 */
class ResetAccountPassword extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountPassword($value)
    {
        $this->data['AccountPassword'] = $value;
        $this->options['form_params']['AccountPassword'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountName($value)
    {
        $this->data['AccountName'] = $value;
        $this->options['form_params']['AccountName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDbInstanceId($value)
    {
        $this->data['DbInstanceId'] = $value;
        $this->options['form_params']['DbInstanceId'] = $value;

        return $this;
    }
}
