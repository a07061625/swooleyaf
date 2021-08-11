<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getLoraVersion()
 * @method string getRequiredCount()
 */
class SubmitNodeTupleOrder extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLoraVersion($value)
    {
        $this->data['LoraVersion'] = $value;
        $this->options['form_params']['LoraVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRequiredCount($value)
    {
        $this->data['RequiredCount'] = $value;
        $this->options['form_params']['RequiredCount'] = $value;

        return $this;
    }
}
