<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCreationType()
 * @method $this withCreationType($value)
 * @method string getInstanceId1()
 * @method string getInstanceId3()
 * @method string getInstanceId2()
 * @method string getInstanceId5()
 * @method string getInstanceId4()
 * @method string getInstanceId7()
 * @method string getInstanceId6()
 * @method string getInstanceId9()
 * @method string getInstanceId8()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScalingConfigurationId()
 * @method $this withScalingConfigurationId($value)
 * @method string getHealthStatus()
 * @method $this withHealthStatus($value)
 * @method string getInstanceId10()
 * @method string getInstanceId12()
 * @method string getInstanceId11()
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getLifecycleState()
 * @method $this withLifecycleState($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getInstanceId20()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getInstanceId18()
 * @method string getInstanceId17()
 * @method string getInstanceId19()
 * @method string getInstanceId14()
 * @method string getInstanceId13()
 * @method string getInstanceId16()
 * @method string getInstanceId15()
 */
class DescribeScalingInstances extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId1($value)
    {
        $this->data['InstanceId1'] = $value;
        $this->options['query']['InstanceId.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId3($value)
    {
        $this->data['InstanceId3'] = $value;
        $this->options['query']['InstanceId.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId2($value)
    {
        $this->data['InstanceId2'] = $value;
        $this->options['query']['InstanceId.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId5($value)
    {
        $this->data['InstanceId5'] = $value;
        $this->options['query']['InstanceId.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId4($value)
    {
        $this->data['InstanceId4'] = $value;
        $this->options['query']['InstanceId.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId7($value)
    {
        $this->data['InstanceId7'] = $value;
        $this->options['query']['InstanceId.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId6($value)
    {
        $this->data['InstanceId6'] = $value;
        $this->options['query']['InstanceId.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId9($value)
    {
        $this->data['InstanceId9'] = $value;
        $this->options['query']['InstanceId.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId8($value)
    {
        $this->data['InstanceId8'] = $value;
        $this->options['query']['InstanceId.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId10($value)
    {
        $this->data['InstanceId10'] = $value;
        $this->options['query']['InstanceId.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId12($value)
    {
        $this->data['InstanceId12'] = $value;
        $this->options['query']['InstanceId.12'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId11($value)
    {
        $this->data['InstanceId11'] = $value;
        $this->options['query']['InstanceId.11'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId20($value)
    {
        $this->data['InstanceId20'] = $value;
        $this->options['query']['InstanceId.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId18($value)
    {
        $this->data['InstanceId18'] = $value;
        $this->options['query']['InstanceId.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId17($value)
    {
        $this->data['InstanceId17'] = $value;
        $this->options['query']['InstanceId.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId19($value)
    {
        $this->data['InstanceId19'] = $value;
        $this->options['query']['InstanceId.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId14($value)
    {
        $this->data['InstanceId14'] = $value;
        $this->options['query']['InstanceId.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId13($value)
    {
        $this->data['InstanceId13'] = $value;
        $this->options['query']['InstanceId.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId16($value)
    {
        $this->data['InstanceId16'] = $value;
        $this->options['query']['InstanceId.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId15($value)
    {
        $this->data['InstanceId15'] = $value;
        $this->options['query']['InstanceId.15'] = $value;

        return $this;
    }
}
