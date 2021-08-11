<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getPolicyName()
 * @method $this withPolicyName($value)
 */
class UpdateILMPolicy extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/ilm-policies/[PolicyName]';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }
}
