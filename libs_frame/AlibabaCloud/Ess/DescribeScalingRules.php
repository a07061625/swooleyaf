<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getScalingRuleId10()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScalingRuleAri1()
 * @method string getScalingRuleAri2()
 * @method string getScalingRuleAri3()
 * @method string getScalingRuleAri4()
 * @method string getScalingRuleAri5()
 * @method string getScalingRuleAri6()
 * @method string getScalingRuleAri7()
 * @method string getScalingRuleAri8()
 * @method string getShowAlarmRules()
 * @method $this withShowAlarmRules($value)
 * @method string getScalingRuleName1()
 * @method string getScalingRuleName2()
 * @method string getScalingRuleName3()
 * @method string getScalingRuleName4()
 * @method string getScalingRuleName5()
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getScalingRuleName6()
 * @method string getScalingRuleName7()
 * @method string getScalingRuleName8()
 * @method string getScalingRuleAri9()
 * @method string getScalingRuleName9()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getScalingRuleType()
 * @method $this withScalingRuleType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getScalingRuleName10()
 * @method string getScalingRuleId8()
 * @method string getScalingRuleId9()
 * @method string getScalingRuleAri10()
 * @method string getScalingRuleId4()
 * @method string getScalingRuleId5()
 * @method string getScalingRuleId6()
 * @method string getScalingRuleId7()
 * @method string getScalingRuleId1()
 * @method string getScalingRuleId2()
 * @method string getScalingRuleId3()
 */
class DescribeScalingRules extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId10($value)
    {
        $this->data['ScalingRuleId10'] = $value;
        $this->options['query']['ScalingRuleId.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri1($value)
    {
        $this->data['ScalingRuleAri1'] = $value;
        $this->options['query']['ScalingRuleAri.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri2($value)
    {
        $this->data['ScalingRuleAri2'] = $value;
        $this->options['query']['ScalingRuleAri.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri3($value)
    {
        $this->data['ScalingRuleAri3'] = $value;
        $this->options['query']['ScalingRuleAri.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri4($value)
    {
        $this->data['ScalingRuleAri4'] = $value;
        $this->options['query']['ScalingRuleAri.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri5($value)
    {
        $this->data['ScalingRuleAri5'] = $value;
        $this->options['query']['ScalingRuleAri.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri6($value)
    {
        $this->data['ScalingRuleAri6'] = $value;
        $this->options['query']['ScalingRuleAri.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri7($value)
    {
        $this->data['ScalingRuleAri7'] = $value;
        $this->options['query']['ScalingRuleAri.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri8($value)
    {
        $this->data['ScalingRuleAri8'] = $value;
        $this->options['query']['ScalingRuleAri.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName1($value)
    {
        $this->data['ScalingRuleName1'] = $value;
        $this->options['query']['ScalingRuleName.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName2($value)
    {
        $this->data['ScalingRuleName2'] = $value;
        $this->options['query']['ScalingRuleName.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName3($value)
    {
        $this->data['ScalingRuleName3'] = $value;
        $this->options['query']['ScalingRuleName.3'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName4($value)
    {
        $this->data['ScalingRuleName4'] = $value;
        $this->options['query']['ScalingRuleName.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName5($value)
    {
        $this->data['ScalingRuleName5'] = $value;
        $this->options['query']['ScalingRuleName.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName6($value)
    {
        $this->data['ScalingRuleName6'] = $value;
        $this->options['query']['ScalingRuleName.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName7($value)
    {
        $this->data['ScalingRuleName7'] = $value;
        $this->options['query']['ScalingRuleName.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName8($value)
    {
        $this->data['ScalingRuleName8'] = $value;
        $this->options['query']['ScalingRuleName.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri9($value)
    {
        $this->data['ScalingRuleAri9'] = $value;
        $this->options['query']['ScalingRuleAri.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName9($value)
    {
        $this->data['ScalingRuleName9'] = $value;
        $this->options['query']['ScalingRuleName.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName10($value)
    {
        $this->data['ScalingRuleName10'] = $value;
        $this->options['query']['ScalingRuleName.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId8($value)
    {
        $this->data['ScalingRuleId8'] = $value;
        $this->options['query']['ScalingRuleId.8'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId9($value)
    {
        $this->data['ScalingRuleId9'] = $value;
        $this->options['query']['ScalingRuleId.9'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleAri10($value)
    {
        $this->data['ScalingRuleAri10'] = $value;
        $this->options['query']['ScalingRuleAri.10'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId4($value)
    {
        $this->data['ScalingRuleId4'] = $value;
        $this->options['query']['ScalingRuleId.4'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId5($value)
    {
        $this->data['ScalingRuleId5'] = $value;
        $this->options['query']['ScalingRuleId.5'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId6($value)
    {
        $this->data['ScalingRuleId6'] = $value;
        $this->options['query']['ScalingRuleId.6'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId7($value)
    {
        $this->data['ScalingRuleId7'] = $value;
        $this->options['query']['ScalingRuleId.7'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId1($value)
    {
        $this->data['ScalingRuleId1'] = $value;
        $this->options['query']['ScalingRuleId.1'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId2($value)
    {
        $this->data['ScalingRuleId2'] = $value;
        $this->options['query']['ScalingRuleId.2'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleId3($value)
    {
        $this->data['ScalingRuleId3'] = $value;
        $this->options['query']['ScalingRuleId.3'] = $value;

        return $this;
    }
}
