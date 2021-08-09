<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AssignUsers
 *
 * @method array getRoleIds()
 * @method array getUserRamIds()
 * @method array getSkillLevels()
 * @method string getInstanceId()
 * @method array getSkillGroupIds()
 */
class AssignUsersRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CCC',
            '2017-07-05',
            'AssignUsers',
            'CCC'
        );
    }

    /**
     * @return $this
     */
    public function setRoleIds(array $roleId)
    {
        $this->requestParameters['RoleIds'] = $roleId;
        foreach ($roleId as $i => $iValue) {
            $this->queryParameters['RoleId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setUserRamIds(array $userRamId)
    {
        $this->requestParameters['UserRamIds'] = $userRamId;
        foreach ($userRamId as $i => $iValue) {
            $this->queryParameters['UserRamId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setSkillLevels(array $skillLevel)
    {
        $this->requestParameters['SkillLevels'] = $skillLevel;
        foreach ($skillLevel as $i => $iValue) {
            $this->queryParameters['SkillLevel.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSkillGroupIds(array $skillGroupId)
    {
        $this->requestParameters['SkillGroupIds'] = $skillGroupId;
        foreach ($skillGroupId as $i => $iValue) {
            $this->queryParameters['SkillGroupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
