<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getScalingGroupId10()
 * @method string getScalingGroupId12()
 * @method string getScalingGroupId13()
 * @method string getScalingGroupId14()
 * @method string getScalingGroupId15()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getScalingGroupName20()
 * @method string getScalingGroupName19()
 * @method string getScalingGroupId20()
 * @method string getScalingGroupName18()
 * @method string getScalingGroupName17()
 * @method string getScalingGroupName16()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getScalingGroupName()
 * @method $this withScalingGroupName($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getScalingGroupName1()
 * @method string getScalingGroupName2()
 * @method string getScalingGroupId2()
 * @method string getScalingGroupId1()
 * @method string getScalingGroupId6()
 * @method string getScalingGroupId16()
 * @method string getScalingGroupName7()
 * @method string getScalingGroupName11()
 * @method string getScalingGroupId5()
 * @method string getScalingGroupId17()
 * @method string getScalingGroupName8()
 * @method string getScalingGroupName10()
 * @method string getScalingGroupId4()
 * @method string getScalingGroupId18()
 * @method string getScalingGroupName9()
 * @method string getScalingGroupId3()
 * @method string getScalingGroupId19()
 * @method string getScalingGroupName3()
 * @method string getScalingGroupName15()
 * @method string getScalingGroupId9()
 * @method string getScalingGroupName4()
 * @method string getScalingGroupName14()
 * @method string getScalingGroupId8()
 * @method string getScalingGroupName5()
 * @method string getScalingGroupName13()
 * @method string getScalingGroupId7()
 * @method string getScalingGroupName6()
 * @method string getScalingGroupName12()
 */
class DescribeScalingGroups extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId10($value)
    {
        $this->data['ScalingGroupId10'] = $value;
        $this->options['query']['ScalingGroupId.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId12($value)
    {
        $this->data['ScalingGroupId12'] = $value;
        $this->options['query']['ScalingGroupId.12'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId13($value)
    {
        $this->data['ScalingGroupId13'] = $value;
        $this->options['query']['ScalingGroupId.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId14($value)
    {
        $this->data['ScalingGroupId14'] = $value;
        $this->options['query']['ScalingGroupId.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId15($value)
    {
        $this->data['ScalingGroupId15'] = $value;
        $this->options['query']['ScalingGroupId.15'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName20($value)
    {
        $this->data['ScalingGroupName20'] = $value;
        $this->options['query']['ScalingGroupName.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName19($value)
    {
        $this->data['ScalingGroupName19'] = $value;
        $this->options['query']['ScalingGroupName.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId20($value)
    {
        $this->data['ScalingGroupId20'] = $value;
        $this->options['query']['ScalingGroupId.20'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName18($value)
    {
        $this->data['ScalingGroupName18'] = $value;
        $this->options['query']['ScalingGroupName.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName17($value)
    {
        $this->data['ScalingGroupName17'] = $value;
        $this->options['query']['ScalingGroupName.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName16($value)
    {
        $this->data['ScalingGroupName16'] = $value;
        $this->options['query']['ScalingGroupName.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName1($value)
    {
        $this->data['ScalingGroupName1'] = $value;
        $this->options['query']['ScalingGroupName.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName2($value)
    {
        $this->data['ScalingGroupName2'] = $value;
        $this->options['query']['ScalingGroupName.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId2($value)
    {
        $this->data['ScalingGroupId2'] = $value;
        $this->options['query']['ScalingGroupId.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId1($value)
    {
        $this->data['ScalingGroupId1'] = $value;
        $this->options['query']['ScalingGroupId.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId6($value)
    {
        $this->data['ScalingGroupId6'] = $value;
        $this->options['query']['ScalingGroupId.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId16($value)
    {
        $this->data['ScalingGroupId16'] = $value;
        $this->options['query']['ScalingGroupId.16'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName7($value)
    {
        $this->data['ScalingGroupName7'] = $value;
        $this->options['query']['ScalingGroupName.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName11($value)
    {
        $this->data['ScalingGroupName11'] = $value;
        $this->options['query']['ScalingGroupName.11'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId5($value)
    {
        $this->data['ScalingGroupId5'] = $value;
        $this->options['query']['ScalingGroupId.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId17($value)
    {
        $this->data['ScalingGroupId17'] = $value;
        $this->options['query']['ScalingGroupId.17'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName8($value)
    {
        $this->data['ScalingGroupName8'] = $value;
        $this->options['query']['ScalingGroupName.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName10($value)
    {
        $this->data['ScalingGroupName10'] = $value;
        $this->options['query']['ScalingGroupName.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId4($value)
    {
        $this->data['ScalingGroupId4'] = $value;
        $this->options['query']['ScalingGroupId.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId18($value)
    {
        $this->data['ScalingGroupId18'] = $value;
        $this->options['query']['ScalingGroupId.18'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName9($value)
    {
        $this->data['ScalingGroupName9'] = $value;
        $this->options['query']['ScalingGroupName.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId3($value)
    {
        $this->data['ScalingGroupId3'] = $value;
        $this->options['query']['ScalingGroupId.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId19($value)
    {
        $this->data['ScalingGroupId19'] = $value;
        $this->options['query']['ScalingGroupId.19'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName3($value)
    {
        $this->data['ScalingGroupName3'] = $value;
        $this->options['query']['ScalingGroupName.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName15($value)
    {
        $this->data['ScalingGroupName15'] = $value;
        $this->options['query']['ScalingGroupName.15'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId9($value)
    {
        $this->data['ScalingGroupId9'] = $value;
        $this->options['query']['ScalingGroupId.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName4($value)
    {
        $this->data['ScalingGroupName4'] = $value;
        $this->options['query']['ScalingGroupName.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName14($value)
    {
        $this->data['ScalingGroupName14'] = $value;
        $this->options['query']['ScalingGroupName.14'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId8($value)
    {
        $this->data['ScalingGroupId8'] = $value;
        $this->options['query']['ScalingGroupId.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName5($value)
    {
        $this->data['ScalingGroupName5'] = $value;
        $this->options['query']['ScalingGroupName.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName13($value)
    {
        $this->data['ScalingGroupName13'] = $value;
        $this->options['query']['ScalingGroupName.13'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupId7($value)
    {
        $this->data['ScalingGroupId7'] = $value;
        $this->options['query']['ScalingGroupId.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName6($value)
    {
        $this->data['ScalingGroupName6'] = $value;
        $this->options['query']['ScalingGroupName.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingGroupName12($value)
    {
        $this->data['ScalingGroupName12'] = $value;
        $this->options['query']['ScalingGroupName.12'] = $value;

        return $this;
    }
}
