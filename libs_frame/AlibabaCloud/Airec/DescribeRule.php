<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getRuleType()
 * @method string getSceneId()
 * @method string getRuleId()
 */
class DescribeRule extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/rules/[ruleId]';

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
    public function withRuleType($value)
    {
        $this->data['RuleType'] = $value;
        $this->options['query']['ruleType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneId($value)
    {
        $this->data['SceneId'] = $value;
        $this->options['query']['sceneId'] = $value;

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
