<?php

namespace AlibabaCloud\LinkFace;

/**
 * @method string getGroupId()
 */
class DeleteGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['form_params']['GroupId'] = $value;

        return $this;
    }
}
