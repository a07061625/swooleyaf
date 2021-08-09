<?php

namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsGroupConsumerUpdate
 *
 * @method string getGroupId()
 * @method string getReadEnable()
 * @method string getInstanceId()
 */
class GroupConsumerUpdateRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsGroupConsumerUpdate', 'ons');
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
     * @param string $readEnable
     *
     * @return $this
     */
    public function setReadEnable($readEnable)
    {
        $this->requestParameters['ReadEnable'] = $readEnable;
        $this->queryParameters['ReadEnable'] = $readEnable;

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
}
