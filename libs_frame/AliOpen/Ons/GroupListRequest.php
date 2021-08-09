<?php

namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsGroupList
 *
 * @method string getGroupId()
 * @method string getInstanceId()
 * @method string getGroupType()
 */
class GroupListRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsGroupList', 'ons');
    }

    /**
     * @param string $groupId
     *
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

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
     * @param string $groupType
     *
     * @return $this
     */
    public function setGroupType($groupType)
    {
        $this->requestParameters['GroupType'] = $groupType;
        $this->queryParameters['GroupType'] = $groupType;

        return $this;
    }
}
