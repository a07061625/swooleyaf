<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListAuditSecurityIp
 * @method string getSecurityGroupName()
 */
class AuditSecurityIpListRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'ListAuditSecurityIp', 'vod');
    }

    /**
     * @param string $securityGroupName
     * @return $this
     */
    public function setSecurityGroupName($securityGroupName)
    {
        $this->requestParameters['SecurityGroupName'] = $securityGroupName;
        $this->queryParameters['SecurityGroupName'] = $securityGroupName;

        return $this;
    }
}
