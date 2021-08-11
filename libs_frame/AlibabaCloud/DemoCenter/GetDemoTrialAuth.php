<?php

namespace AlibabaCloud\DemoCenter;

/**
 * @method string getDemoId()
 */
class GetDemoTrialAuth extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';

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
