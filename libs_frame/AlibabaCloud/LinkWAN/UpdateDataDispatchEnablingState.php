<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupId()
 * @method string getDataDispatchEnabled()
 */
class UpdateDataDispatchEnablingState extends Rpc
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
    public function withDataDispatchEnabled($value)
    {
        $this->data['DataDispatchEnabled'] = $value;
        $this->options['form_params']['DataDispatchEnabled'] = $value;

        return $this;
    }
}
