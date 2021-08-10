<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method array getStates()
 */
class CountGatewayTupleOrders extends Rpc
{
    /**
     * @return $this
     */
    public function withStates(array $states)
    {
        $this->data['States'] = $states;
        foreach ($states as $i => $iValue) {
            $this->options['form_params']['States.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
