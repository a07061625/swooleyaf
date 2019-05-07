<?php
namespace AliOpen\Core\Auth;

class EcsRamRoleCredential extends AbstractCredential
{
    /**
     * @var string
     */
    private $roleName;

    /**
     * AliOpen\Core\Auth\EcsRamRoleCredential constructor.
     * @param $roleName
     */
    public function __construct($roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * @return null
     */
    public function getAccessKeyId()
    {
    }

    /**
     * @return null
     */
    public function getAccessSecret()
    {
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * @return null
     */
    public function getSecurityToken()
    {
    }
}
