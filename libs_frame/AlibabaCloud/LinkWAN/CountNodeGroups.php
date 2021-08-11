<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyName()
 * @method string getFuzzyJoinEui()
 * @method string getFuzzyDevEui()
 */
class CountNodeGroups extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyName($value)
    {
        $this->data['FuzzyName'] = $value;
        $this->options['form_params']['FuzzyName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyJoinEui($value)
    {
        $this->data['FuzzyJoinEui'] = $value;
        $this->options['form_params']['FuzzyJoinEui'] = $value;

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
