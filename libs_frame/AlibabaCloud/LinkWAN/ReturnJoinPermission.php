<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getJoinPermissionId()
 * @method string getJoinPermissionType()
 */
class ReturnJoinPermission extends Rpc
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
    public function withJoinPermissionType($value)
    {
        $this->data['JoinPermissionType'] = $value;
        $this->options['form_params']['JoinPermissionType'] = $value;

        return $this;
    }
}
