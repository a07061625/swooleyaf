<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getSpaceId()
 * @method string getFunctionId()
 */
class DeleteFunction extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFunctionId($value)
    {
        $this->data['FunctionId'] = $value;
        $this->options['form_params']['FunctionId'] = $value;

        return $this;
    }
}
