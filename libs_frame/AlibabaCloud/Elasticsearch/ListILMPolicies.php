<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPolicyName()
 */
class ListILMPolicies extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/ilm-policies';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPolicyName($value)
    {
        $this->data['PolicyName'] = $value;
        $this->options['query']['policyName'] = $value;

        return $this;
    }
}
