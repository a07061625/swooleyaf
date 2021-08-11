<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getRequiredCount()
 */
class SubmitGatewayTupleOrder extends Rpc
{
    /** @var string */
    public $scheme = 'http';

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
