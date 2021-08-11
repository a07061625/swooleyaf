<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getPolicyName()
 * @method $this withPolicyName($value)
 */
class DescribeILMPolicy extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/ilm-policies/[PolicyName]';

    /** @var string */
    public $method = 'GET';
}
