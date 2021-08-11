<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getJoinPermissionId()
 */
class GetRentedJoinPermission extends Rpc
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
}
