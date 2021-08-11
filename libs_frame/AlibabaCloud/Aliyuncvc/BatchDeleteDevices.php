<?php

namespace AlibabaCloud\Aliyuncvc;

/**
 * @method string getGroupId()
 * @method string getSN()
 */
class BatchDeleteDevices extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSN($value)
    {
        $this->data['SN'] = $value;
        $this->options['form_params']['SN'] = $value;

        return $this;
    }
}
