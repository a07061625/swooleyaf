<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getRuleId()
 */
class EnableFlowControl extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/flowcontrol/enable';

    /** @var string */
    public $method = 'PUT';

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
    public function withRuleId($value)
    {
        $this->data['RuleId'] = $value;
        $this->options['query']['RuleId'] = $value;

        return $this;
    }
}
