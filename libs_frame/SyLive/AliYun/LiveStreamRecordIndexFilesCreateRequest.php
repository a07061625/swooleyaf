<?php
namespace SyLive\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateLiveStreamRecordIndexFiles
 * @method string getOssBucket()
 * @method string getAppName()
 * @method string getSecurityToken()
 * @method string getDomainName()
 * @method string getOssEndpoint()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getOwnerId()
 * @method string getStreamName()
 * @method string getOssObject()
 */
class LiveStreamRecordIndexFilesCreateRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'CreateLiveStreamRecordIndexFiles', 'live');
    }

    /**
     * @param string $ossBucket
     * @return $this
     */
    public function setOssBucket($ossBucket)
    {
        $this->requestParameters['OssBucket'] = $ossBucket;
        $this->queryParameters['OssBucket'] = $ossBucket;

        return $this;
    }

    /**
     * @param string $appName
     * @return $this
     */
    public function setAppName($appName)
    {
        $this->requestParameters['AppName'] = $appName;
        $this->queryParameters['AppName'] = $appName;

        return $this;
    }

    /**
     * @param string $securityToken
     * @return $this
     */
    public function setSecurityToken($securityToken)
    {
        $this->requestParameters['SecurityToken'] = $securityToken;
        $this->queryParameters['SecurityToken'] = $securityToken;

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
     * @param string $ossEndpoint
     * @return $this
     */
    public function setOssEndpoint($ossEndpoint)
    {
        $this->requestParameters['OssEndpoint'] = $ossEndpoint;
        $this->queryParameters['OssEndpoint'] = $ossEndpoint;

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

    /**
     * @param string $streamName
     * @return $this
     */
    public function setStreamName($streamName)
    {
        $this->requestParameters['StreamName'] = $streamName;
        $this->queryParameters['StreamName'] = $streamName;

        return $this;
    }

    /**
     * @param string $ossObject
     * @return $this
     */
    public function setOssObject($ossObject)
    {
        $this->requestParameters['OssObject'] = $ossObject;
        $this->queryParameters['OssObject'] = $ossObject;

        return $this;
    }
}
