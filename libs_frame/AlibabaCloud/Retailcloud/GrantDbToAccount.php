<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAccountName()
 * @method string getDbName()
 * @method string getDbInstanceId()
 * @method string getAccountPrivilege()
 */
class GrantDbToAccount extends Rpc
{
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
    public function withDbName($value)
    {
        $this->data['DbName'] = $value;
        $this->options['form_params']['DbName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountPrivilege($value)
    {
        $this->data['AccountPrivilege'] = $value;
        $this->options['form_params']['AccountPrivilege'] = $value;

        return $this;
    }
}
