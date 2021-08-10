<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getJoinPermissionId()
 * @method string getJoinPermissionName()
 */
class UpdateRoamingJoinPermission extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJoinPermissionId($value)
    {
        $this->data['JoinPermissionId'] = $value;
        $this->options['form_params']['JoinPermissionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJoinPermissionName($value)
    {
        $this->data['JoinPermissionName'] = $value;
        $this->options['form_params']['JoinPermissionName'] = $value;

        return $this;
    }
}
