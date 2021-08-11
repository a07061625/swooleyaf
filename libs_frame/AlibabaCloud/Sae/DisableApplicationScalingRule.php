<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getScalingRuleName()
 * @method string getAppId()
 */
class DisableApplicationScalingRule extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/scale/disableApplicationScalingRule';

    /** @var string */
    public $method = 'PUT';

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
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }
}
