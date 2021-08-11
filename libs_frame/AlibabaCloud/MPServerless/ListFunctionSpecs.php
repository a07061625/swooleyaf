<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getSpaceId()
 */
class ListFunctionSpecs extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpaceId($value)
    {
        $this->data['SpaceId'] = $value;
        $this->options['form_params']['SpaceId'] = $value;

        return $this;
    }
}
