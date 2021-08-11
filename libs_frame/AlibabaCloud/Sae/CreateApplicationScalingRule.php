<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getScalingRuleName()
 * @method string getMinReadyInstances()
 * @method string getScalingRuleTimer()
 * @method string getScalingRuleMetric()
 * @method string getAppId()
 * @method string getScalingRuleType()
 */
class CreateApplicationScalingRule extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/scale/applicationScalingRule';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleName($value)
    {
        $this->data['ScalingRuleName'] = $value;
        $this->options['query']['ScalingRuleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinReadyInstances($value)
    {
        $this->data['MinReadyInstances'] = $value;
        $this->options['query']['MinReadyInstances'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleTimer($value)
    {
        $this->data['ScalingRuleTimer'] = $value;
        $this->options['query']['ScalingRuleTimer'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleMetric($value)
    {
        $this->data['ScalingRuleMetric'] = $value;
        $this->options['query']['ScalingRuleMetric'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScalingRuleType($value)
    {
        $this->data['ScalingRuleType'] = $value;
        $this->options['query']['ScalingRuleType'] = $value;

        return $this;
    }
}
