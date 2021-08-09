<?php
namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of RemoveUsersFromSkillGroup
 *
 * @method array getUserIds()
 * @method string getInstanceId()
 * @method string getSkillGroupId()
 */
class RemoveUsersFromSkillGroupRequest extends RpcAcsRequest
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
            'RemoveUsersFromSkillGroup',
            'CCC'
        );
    }

    /**
     * @param array $userId
     *
     * @return $this
     */
	public function setUserIds(array $userId)
	{
	    $this->requestParameters['UserIds'] = $userId;
		foreach ($userId as $i => $iValue) {
			$this->queryParameters['UserId.' . ($i + 1)] = $iValue;
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
     * @param string $skillGroupId
     *
     * @return $this
     */
    public function setSkillGroupId($skillGroupId)
    {
        $this->requestParameters['SkillGroupId'] = $skillGroupId;
        $this->queryParameters['SkillGroupId'] = $skillGroupId;

        return $this;
    }
}
