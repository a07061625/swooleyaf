<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyName()
 * @method string getActivationState()
 * @method string getFreqBandPlanGroupId()
 * @method string getFuzzyDevEui()
 */
class CountLabNodes extends Rpc
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
    public function withActivationState($value)
    {
        $this->data['ActivationState'] = $value;
        $this->options['form_params']['ActivationState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFreqBandPlanGroupId($value)
    {
        $this->data['FreqBandPlanGroupId'] = $value;
        $this->options['form_params']['FreqBandPlanGroupId'] = $value;

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
