<?php

namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsMqttQueryMsgTransTrend
 *
 * @method string getTransType()
 * @method string getEndTime()
 * @method string getBeginTime()
 * @method string getTpsType()
 * @method string getParentTopic()
 * @method string getInstanceId()
 * @method string getQos()
 * @method string getMsgType()
 * @method string getSubTopic()
 */
class MqttQueryMsgTransTrendRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsMqttQueryMsgTransTrend', 'ons');
    }

    /**
     * @param string $transType
     *
     * @return $this
     */
    public function setTransType($transType)
    {
        $this->requestParameters['TransType'] = $transType;
        $this->queryParameters['TransType'] = $transType;

        return $this;
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
     * @param string $tpsType
     *
     * @return $this
     */
    public function setTpsType($tpsType)
    {
        $this->requestParameters['TpsType'] = $tpsType;
        $this->queryParameters['TpsType'] = $tpsType;

        return $this;
    }

    /**
     * @param string $parentTopic
     *
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
     * @param string $qos
     *
     * @return $this
     */
    public function setQos($qos)
    {
        $this->requestParameters['Qos'] = $qos;
        $this->queryParameters['Qos'] = $qos;

        return $this;
    }

    /**
     * @param string $msgType
     *
     * @return $this
     */
    public function setMsgType($msgType)
    {
        $this->requestParameters['MsgType'] = $msgType;
        $this->queryParameters['MsgType'] = $msgType;

        return $this;
    }

    /**
     * @param string $subTopic
     *
     * @return $this
     */
    public function setSubTopic($subTopic)
    {
        $this->requestParameters['SubTopic'] = $subTopic;
        $this->queryParameters['SubTopic'] = $subTopic;

        return $this;
    }
}
