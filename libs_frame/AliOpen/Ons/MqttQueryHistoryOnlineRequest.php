<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsMqttQueryHistoryOnline
 * @method string getGroupId()
 * @method string getEndTime()
 * @method string getBeginTime()
 * @method string getInstanceId()
 */
class MqttQueryHistoryOnlineRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsMqttQueryHistoryOnline', 'ons');
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
     * @param string $endTime
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $beginTime
     * @return $this
     */
    public function setBeginTime($beginTime)
    {
        $this->requestParameters['BeginTime'] = $beginTime;
        $this->queryParameters['BeginTime'] = $beginTime;

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
