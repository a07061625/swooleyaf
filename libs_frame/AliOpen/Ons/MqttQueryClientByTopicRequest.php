<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsMqttQueryClientByTopic
 * @method string getParentTopic()
 * @method string getInstanceId()
 * @method string getSubTopic()
 */
class MqttQueryClientByTopicRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsMqttQueryClientByTopic', 'ons');
    }

    /**
     * @param string $parentTopic
     * @return $this
     */
    public function setParentTopic($parentTopic)
    {
        $this->requestParameters['ParentTopic'] = $parentTopic;
        $this->queryParameters['ParentTopic'] = $parentTopic;

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

    /**
     * @param string $subTopic
     * @return $this
     */
    public function setSubTopic($subTopic)
    {
        $this->requestParameters['SubTopic'] = $subTopic;
        $this->queryParameters['SubTopic'] = $subTopic;

        return $this;
    }
}
