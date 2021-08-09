<?php
namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsTopicCreate
 * @method string getMessageType()
 * @method string getRemark()
 * @method string getInstanceId()
 * @method string getTopic()
 */
class TopicCreateRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsTopicCreate', 'ons');
    }

    /**
     * @param string $messageType
     * @return $this
     */
    public function setMessageType($messageType)
    {
        $this->requestParameters['MessageType'] = $messageType;
        $this->queryParameters['MessageType'] = $messageType;

        return $this;
    }

    /**
     * @param string $remark
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->requestParameters['Remark'] = $remark;
        $this->queryParameters['Remark'] = $remark;

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
     * @param string $topic
     * @return $this
     */
    public function setTopic($topic)
    {
        $this->requestParameters['Topic'] = $topic;
        $this->queryParameters['Topic'] = $topic;

        return $this;
    }
}
