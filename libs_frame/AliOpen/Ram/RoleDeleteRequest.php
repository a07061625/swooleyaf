<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteRole
 * @method string getRoleName()
 */
class RoleDeleteRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'DeleteRole', 'ram');
    }

    /**
     * @param string $roleName
     * @return $this
     */
    public function setRoleName($roleName)
    {
        $this->requestParameters['RoleName'] = $roleName;
        $this->queryParameters['RoleName'] = $roleName;

        return $this;
    }
}
