<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRealtimeDeliveryAcc
 * @method string getProject()
 * @method string getStartTime()
 * @method string getEndTime()
 * @method string getOwnerId()
 * @method string getInterval()
 * @method string getLogStore()
 */
class RealtimeDeliveryAccDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'DescribeRealtimeDeliveryAcc');
    }

    /**
     * @param string $project
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

        return $this;
    }

    /**
     * @param string $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

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
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $interval
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->requestParameters['Interval'] = $interval;
        $this->queryParameters['Interval'] = $interval;

        return $this;
    }

    /**
     * @param string $logStore
     * @return $this
     */
    public function setLogStore($logStore)
    {
        $this->requestParameters['LogStore'] = $logStore;
        $this->queryParameters['LogStore'] = $logStore;

        return $this;
    }
}
