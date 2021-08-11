<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getRunParams()
 * @method string getSpaceId()
 */
class RunFunction extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRunParams($value)
    {
        $this->data['RunParams'] = $value;
        $this->options['form_params']['RunParams'] = $value;

        return $this;
    }

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
