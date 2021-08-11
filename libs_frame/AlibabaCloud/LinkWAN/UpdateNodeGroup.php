<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupName()
 * @method string getNodeGroupId()
 */
class UpdateNodeGroup extends Rpc
{
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
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }
}
