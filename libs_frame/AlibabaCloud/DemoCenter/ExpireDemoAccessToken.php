<?php

namespace AlibabaCloud\DemoCenter;

/**
 * @method string getDemoAccessToken()
 */
class ExpireDemoAccessToken extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDemoAccessToken($value)
    {
        $this->data['DemoAccessToken'] = $value;
        $this->options['form_params']['DemoAccessToken'] = $value;

        return $this;
    }
}
