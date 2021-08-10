<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getIsKpm()
 * @method array getStates()
 */
class CountNodeTupleOrders extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsKpm($value)
    {
        $this->data['IsKpm'] = $value;
        $this->options['form_params']['IsKpm'] = $value;

        return $this;
    }

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
