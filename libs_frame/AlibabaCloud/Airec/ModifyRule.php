<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getRuleId()
 */
class ModifyRule extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/rules/[ruleId]';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

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
        $this->pathParameters['ruleId'] = $value;

        return $this;
    }
}
