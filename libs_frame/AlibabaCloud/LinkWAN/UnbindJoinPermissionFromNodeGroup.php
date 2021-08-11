<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupId()
 * @method string getJoinPermissionId()
 */
class UnbindJoinPermissionFromNodeGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }

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
