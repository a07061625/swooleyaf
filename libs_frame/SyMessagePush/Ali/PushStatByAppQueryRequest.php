<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryPushStatByApp
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getGranularity()
 * @method string getAppKey()
 */
class PushStatByAppQueryRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'QueryPushStatByApp');
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
     * @param string $granularity
     * @return $this
     */
    public function setGranularity($granularity)
    {
        $this->requestParameters['Granularity'] = $granularity;
        $this->queryParameters['Granularity'] = $granularity;

        return $this;
    }

    /**
     * @param string $appKey
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->requestParameters['AppKey'] = $appKey;
        $this->queryParameters['AppKey'] = $appKey;

        return $this;
    }
}
