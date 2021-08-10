<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupId()
 */
class DeleteNodeGroup extends Rpc
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
}
