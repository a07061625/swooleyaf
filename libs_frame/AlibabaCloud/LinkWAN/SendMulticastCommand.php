<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getMcAddress()
 * @method string getFPort()
 * @method string getContent()
 */
class SendMulticastCommand extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMcAddress($value)
    {
        $this->data['McAddress'] = $value;
        $this->options['form_params']['McAddress'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFPort($value)
    {
        $this->data['FPort'] = $value;
        $this->options['form_params']['FPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }
}
