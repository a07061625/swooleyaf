<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getRoleCode()
 * @method string getExtraParams()
 * @method string getClientToken()
 * @method string getAccessControlLists()
 */
class AddRoleActions extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoleCode($value)
    {
        $this->data['RoleCode'] = $value;
        $this->options['form_params']['RoleCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessControlLists($value)
    {
        $this->data['AccessControlLists'] = $value;
        $this->options['form_params']['AccessControlLists'] = $value;

        return $this;
    }
}
