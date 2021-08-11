<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getBizCode()
 * @method string getName()
 */
class CreateAppGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizCode($value)
    {
        $this->data['BizCode'] = $value;
        $this->options['form_params']['BizCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }
}
