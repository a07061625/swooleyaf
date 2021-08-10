<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getDevEui()
 * @method string getMaxRetries()
 * @method string getCleanUp()
 * @method string getFPort()
 * @method string getComfirmed()
 * @method string getContent()
 */
class SendUnicastCommand extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDevEui($value)
    {
        $this->data['DevEui'] = $value;
        $this->options['form_params']['DevEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxRetries($value)
    {
        $this->data['MaxRetries'] = $value;
        $this->options['form_params']['MaxRetries'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCleanUp($value)
    {
        $this->data['CleanUp'] = $value;
        $this->options['form_params']['CleanUp'] = $value;

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
    public function withComfirmed($value)
    {
        $this->data['Comfirmed'] = $value;
        $this->options['form_params']['Comfirmed'] = $value;

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
