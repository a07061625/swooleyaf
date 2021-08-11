<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getScalingRuleName()
 * @method string getAppId()
 */
class DeleteApplicationScalingRule extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/scale/applicationScalingRule';

    /** @var string */
    public $method = 'DELETE';

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
