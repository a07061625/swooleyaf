<?php

namespace AliOpen\Rtc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRtcPeakChannelCntData
 *
 * @method string getStartTime()
 * @method string getServiceArea()
 * @method string getEndTime()
 * @method string getOwnerId()
 * @method string getAppId()
 * @method string getInterval()
 */
class DescribeRtcPeakChannelCntDataRequest extends RpcAcsRequest
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
        parent::__construct('rtc', '2018-01-11', 'DescribeRtcPeakChannelCntData', 'rtc');
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $serviceArea
     *
     * @return $this
     */
    public function setServiceArea($serviceArea)
    {
        $this->requestParameters['ServiceArea'] = $serviceArea;
        $this->queryParameters['ServiceArea'] = $serviceArea;

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
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $appId
     *
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }

    /**
     * @param string $interval
     *
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->requestParameters['Interval'] = $interval;
        $this->queryParameters['Interval'] = $interval;

        return $this;
    }
}
