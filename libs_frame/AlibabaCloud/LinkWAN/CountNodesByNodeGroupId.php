<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNodeGroupId()
 * @method string getFuzzyDevEui()
 */
class CountNodesByNodeGroupId extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeGroupId($value)
    {
        $this->data['NodeGroupId'] = $value;
        $this->options['form_params']['NodeGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyDevEui($value)
    {
        $this->data['FuzzyDevEui'] = $value;
        $this->options['form_params']['FuzzyDevEui'] = $value;

        return $this;
    }
}
