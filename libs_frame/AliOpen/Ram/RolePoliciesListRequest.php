<?php

namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListPoliciesForRole
 *
 * @method string getRoleName()
 */
class RolePoliciesListRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'ListPoliciesForRole', 'ram');
    }

    /**
     * @param string $roleName
     *
     * @return $this
     */
    public function setRoleName($roleName)
    {
        $this->requestParameters['RoleName'] = $roleName;
        $this->queryParameters['RoleName'] = $roleName;

        return $this;
    }
}
