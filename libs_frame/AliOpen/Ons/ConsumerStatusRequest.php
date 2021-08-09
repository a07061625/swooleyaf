<?php

namespace AliOpen\Ons;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OnsConsumerStatus
 *
 * @method string getGroupId()
 * @method string getInstanceId()
 * @method string getNeedJstack()
 * @method string getDetail()
 */
class ConsumerStatusRequest extends RpcAcsRequest
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
        parent::__construct('Ons', '2019-02-14', 'OnsConsumerStatus', 'ons');
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
     * @param string $needJstack
     *
     * @return $this
     */
    public function setNeedJstack($needJstack)
    {
        $this->requestParameters['NeedJstack'] = $needJstack;
        $this->queryParameters['NeedJstack'] = $needJstack;

        return $this;
    }

    /**
     * @param string $detail
     *
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->requestParameters['Detail'] = $detail;
        $this->queryParameters['Detail'] = $detail;

        return $this;
    }
}
