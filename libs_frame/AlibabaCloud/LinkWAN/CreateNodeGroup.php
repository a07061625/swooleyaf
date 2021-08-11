<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupName()
 * @method string getJoinPermissionId()
 */
class CreateNodeGroup extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupName($value)
    {
        $this->data['NodeGroupName'] = $value;
        $this->options['form_params']['NodeGroupName'] = $value;

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
