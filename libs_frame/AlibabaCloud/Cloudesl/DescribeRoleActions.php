<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getRoleCode()
 * @method string getExtraParams()
 */
class DescribeRoleActions extends Rpc
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
}
