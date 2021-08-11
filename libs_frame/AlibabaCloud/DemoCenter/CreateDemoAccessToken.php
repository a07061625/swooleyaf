<?php

namespace AlibabaCloud\DemoCenter;

/**
 * @method string getEdition()
 * @method string getDemoId()
 */
class CreateDemoAccessToken extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEdition($value)
    {
        $this->data['Edition'] = $value;
        $this->options['form_params']['Edition'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDemoId($value)
    {
        $this->data['DemoId'] = $value;
        $this->options['form_params']['DemoId'] = $value;

        return $this;
    }
}
