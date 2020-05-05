<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeHlsLiveStreamRealTimeBpsData
 * @method string getDomainName()
 * @method string getTime()
 * @method string getOwnerId()
 */
class HlsLiveStreamRealTimeBpsDataDescribeRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('live', '2016-11-01', 'DescribeHlsLiveStreamRealTimeBpsData', 'live');
    }

    /**
     * @param string $domainName
     * @return $this
     */
    public function setDomainName($domainName)
    {
        $this->requestParameters['DomainName'] = $domainName;
        $this->queryParameters['DomainName'] = $domainName;

        return $this;
    }

    /**
     * @param string $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->requestParameters['Time'] = $time;
        $this->queryParameters['Time'] = $time;

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
}
