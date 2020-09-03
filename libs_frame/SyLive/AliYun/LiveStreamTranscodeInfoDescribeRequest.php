<?php
namespace SyLive\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeLiveStreamTranscodeInfo
 * @method string getSecurityToken()
 * @method string getOwnerId()
 * @method string getDomainTranscodeName()
 */
class LiveStreamTranscodeInfoDescribeRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DescribeLiveStreamTranscodeInfo', 'live');
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
     * @param string $domainTranscodeName
     * @return $this
     */
    public function setDomainTranscodeName($domainTranscodeName)
    {
        $this->requestParameters['DomainTranscodeName'] = $domainTranscodeName;
        $this->queryParameters['DomainTranscodeName'] = $domainTranscodeName;

        return $this;
    }
}
