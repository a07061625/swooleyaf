<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyGwEui()
 * @method string getLimit()
 * @method string getFuzzyCity()
 * @method string getOnlineState()
 * @method string getIsEnabled()
 * @method string getFuzzyName()
 * @method string getOffset()
 * @method string getFreqBandPlanGroupId()
 * @method string getSortingField()
 * @method string getAscending()
 */
class ListGateways extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyGwEui($value)
    {
        $this->data['FuzzyGwEui'] = $value;
        $this->options['form_params']['FuzzyGwEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['form_params']['Limit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyCity($value)
    {
        $this->data['FuzzyCity'] = $value;
        $this->options['form_params']['FuzzyCity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOnlineState($value)
    {
        $this->data['OnlineState'] = $value;
        $this->options['form_params']['OnlineState'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsEnabled($value)
    {
        $this->data['IsEnabled'] = $value;
        $this->options['form_params']['IsEnabled'] = $value;

        return $this;
    }

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
    public function withOffset($value)
    {
        $this->data['Offset'] = $value;
        $this->options['form_params']['Offset'] = $value;

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
    public function withSortingField($value)
    {
        $this->data['SortingField'] = $value;
        $this->options['form_params']['SortingField'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAscending($value)
    {
        $this->data['Ascending'] = $value;
        $this->options['form_params']['Ascending'] = $value;

        return $this;
    }
}
