<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateRole
 * @method string getNewAssumeRolePolicyDocument()
 * @method string getRoleName()
 */
class RoleUpdateRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'UpdateRole', 'ram');
    }

    /**
     * @param string $newAssumeRolePolicyDocument
     * @return $this
     */
    public function setNewAssumeRolePolicyDocument($newAssumeRolePolicyDocument)
    {
        $this->requestParameters['NewAssumeRolePolicyDocument'] = $newAssumeRolePolicyDocument;
        $this->queryParameters['NewAssumeRolePolicyDocument'] = $newAssumeRolePolicyDocument;

        return $this;
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
