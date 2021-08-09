<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeletePolicy
 * @method string getPolicyName()
 */
class PolicyDeleteRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'DeletePolicy', 'ram');
    }

    /**
     * @param string $policyName
     * @return $this
     */
    public function setPolicyName($policyName)
    {
        $this->requestParameters['PolicyName'] = $policyName;
        $this->queryParameters['PolicyName'] = $policyName;

        return $this;
    }
}
