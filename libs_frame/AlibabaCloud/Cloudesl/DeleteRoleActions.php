<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getRoleCode()
 * @method string getExtraParams()
 * @method string getAccessControlLists()
 */
class DeleteRoleActions extends Rpc
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
    public function withAccessControlLists($value)
    {
        $this->data['AccessControlLists'] = $value;
        $this->options['form_params']['AccessControlLists'] = $value;

        return $this;
    }
}
