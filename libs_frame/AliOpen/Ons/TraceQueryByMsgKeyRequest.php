<?php

namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsTraceQueryByMsgKey
 *
 * @method string getEndTime()
 * @method string getBeginTime()
 * @method string getInstanceId()
 * @method string getTopic()
 * @method string getMsgKey()
 */
class TraceQueryByMsgKeyRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsTraceQueryByMsgKey', 'ons');
    }

    /**
     * @param string $endTime
     *
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
     *
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
     * @param string $topic
     *
     * @return $this
     */
    public function setTopic($topic)
    {
        $this->requestParameters['Topic'] = $topic;
        $this->queryParameters['Topic'] = $topic;

        return $this;
    }

    /**
     * @param string $msgKey
     *
     * @return $this
     */
    public function setMsgKey($msgKey)
    {
        $this->requestParameters['MsgKey'] = $msgKey;
        $this->queryParameters['MsgKey'] = $msgKey;

        return $this;
    }
}
