<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsMqttQueryClientByGroupId
 * @method string getGroupId()
 * @method string getInstanceId()
 */
class MqttQueryClientByGroupIdRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsMqttQueryClientByGroupId', 'ons');
    }

    /**
     * @param string $groupId
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
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
