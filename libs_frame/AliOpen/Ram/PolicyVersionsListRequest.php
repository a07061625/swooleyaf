<?php

namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListPolicyVersions
 *
 * @method string getPolicyType()
 * @method string getPolicyName()
 */
class PolicyVersionsListRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Ram', '2015-05-01', 'ListPolicyVersions', 'ram');
    }

    /**
     * @param string $policyType
     *
     * @return $this
     */
    public function setPolicyType($policyType)
    {
        $this->requestParameters['PolicyType'] = $policyType;
        $this->queryParameters['PolicyType'] = $policyType;

        return $this;
    }

    /**
     * @param string $policyName
     *
     * @return $this
     */
    public function setPolicyName($policyName)
    {
        $this->requestParameters['PolicyName'] = $policyName;
        $this->queryParameters['PolicyName'] = $policyName;

        return $this;
    }
}
