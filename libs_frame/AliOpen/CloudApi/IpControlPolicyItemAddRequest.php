<?php
namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AddIpControlPolicyItem
 * @method string getIpControlId()
 * @method string getSecurityToken()
 * @method string getAppId()
 * @method string getCidrIp()
 */
class IpControlPolicyItemAddRequest extends RpcAcsRequest
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
        parent::__construct('CloudAPI', '2016-07-14', 'AddIpControlPolicyItem', 'apigateway');
    }

    /**
     * @param string $ipControlId
     * @return $this
     */
    public function setIpControlId($ipControlId)
    {
        $this->requestParameters['IpControlId'] = $ipControlId;
        $this->queryParameters['IpControlId'] = $ipControlId;

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
     * @param string $appId
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }

    /**
     * @param string $cidrIp
     * @return $this
     */
    public function setCidrIp($cidrIp)
    {
        $this->requestParameters['CidrIp'] = $cidrIp;
        $this->queryParameters['CidrIp'] = $cidrIp;

        return $this;
    }
}
