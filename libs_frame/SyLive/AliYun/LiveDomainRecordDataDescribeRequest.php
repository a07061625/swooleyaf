<?php
namespace SyLive\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeLiveDomainRecordData
 * @method string getRecordType()
 * @method string getDomainName()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getOwnerId()
 */
class LiveDomainRecordDataDescribeRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DescribeLiveDomainRecordData', 'live');
    }

    /**
     * @param string $recordType
     * @return $this
     */
    public function setRecordType($recordType)
    {
        $this->requestParameters['RecordType'] = $recordType;
        $this->queryParameters['RecordType'] = $recordType;

        return $this;
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
