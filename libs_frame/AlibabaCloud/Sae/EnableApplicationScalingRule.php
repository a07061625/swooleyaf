<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getScalingRuleName()
 * @method string getAppId()
 */
class EnableApplicationScalingRule extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/scale/enableApplicationScalingRule';

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
