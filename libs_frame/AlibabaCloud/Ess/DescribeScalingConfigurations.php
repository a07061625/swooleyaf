<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getScalingConfigurationId6()
 * @method string getScalingConfigurationId7()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getScalingConfigurationId4()
 * @method string getScalingConfigurationId5()
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getScalingConfigurationId8()
 * @method string getScalingConfigurationId9()
 * @method string getScalingConfigurationId10()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getScalingConfigurationName2()
 * @method string getScalingConfigurationName3()
 * @method string getScalingConfigurationName1()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getScalingConfigurationId2()
 * @method string getScalingConfigurationId3()
 * @method string getScalingConfigurationId1()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getScalingConfigurationName6()
 * @method string getScalingConfigurationName7()
 * @method string getScalingConfigurationName4()
 * @method string getScalingConfigurationName5()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScalingConfigurationName8()
 * @method string getScalingConfigurationName9()
 * @method string getScalingConfigurationName10()
 */
class DescribeScalingConfigurations extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId6($value)
    {
        $this->data['ScalingConfigurationId6'] = $value;
        $this->options['query']['ScalingConfigurationId.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId7($value)
    {
        $this->data['ScalingConfigurationId7'] = $value;
        $this->options['query']['ScalingConfigurationId.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId4($value)
    {
        $this->data['ScalingConfigurationId4'] = $value;
        $this->options['query']['ScalingConfigurationId.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId5($value)
    {
        $this->data['ScalingConfigurationId5'] = $value;
        $this->options['query']['ScalingConfigurationId.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId8($value)
    {
        $this->data['ScalingConfigurationId8'] = $value;
        $this->options['query']['ScalingConfigurationId.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId9($value)
    {
        $this->data['ScalingConfigurationId9'] = $value;
        $this->options['query']['ScalingConfigurationId.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId10($value)
    {
        $this->data['ScalingConfigurationId10'] = $value;
        $this->options['query']['ScalingConfigurationId.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName2($value)
    {
        $this->data['ScalingConfigurationName2'] = $value;
        $this->options['query']['ScalingConfigurationName.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName3($value)
    {
        $this->data['ScalingConfigurationName3'] = $value;
        $this->options['query']['ScalingConfigurationName.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName1($value)
    {
        $this->data['ScalingConfigurationName1'] = $value;
        $this->options['query']['ScalingConfigurationName.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId2($value)
    {
        $this->data['ScalingConfigurationId2'] = $value;
        $this->options['query']['ScalingConfigurationId.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId3($value)
    {
        $this->data['ScalingConfigurationId3'] = $value;
        $this->options['query']['ScalingConfigurationId.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationId1($value)
    {
        $this->data['ScalingConfigurationId1'] = $value;
        $this->options['query']['ScalingConfigurationId.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName6($value)
    {
        $this->data['ScalingConfigurationName6'] = $value;
        $this->options['query']['ScalingConfigurationName.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName7($value)
    {
        $this->data['ScalingConfigurationName7'] = $value;
        $this->options['query']['ScalingConfigurationName.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName4($value)
    {
        $this->data['ScalingConfigurationName4'] = $value;
        $this->options['query']['ScalingConfigurationName.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName5($value)
    {
        $this->data['ScalingConfigurationName5'] = $value;
        $this->options['query']['ScalingConfigurationName.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName8($value)
    {
        $this->data['ScalingConfigurationName8'] = $value;
        $this->options['query']['ScalingConfigurationName.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName9($value)
    {
        $this->data['ScalingConfigurationName9'] = $value;
        $this->options['query']['ScalingConfigurationName.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingConfigurationName10($value)
    {
        $this->data['ScalingConfigurationName10'] = $value;
        $this->options['query']['ScalingConfigurationName.10'] = $value;

        return $this;
    }
}
