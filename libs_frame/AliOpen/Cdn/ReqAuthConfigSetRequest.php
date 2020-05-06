<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetReqAuthConfig
 * @method string getKey1()
 * @method string getKey2()
 * @method string getTimeOut()
 * @method string getAuthType()
 * @method string getAuthRemoteDesc()
 * @method string getSecurityToken()
 * @method string getDomainName()
 * @method string getOwnerId()
 */
class ReqAuthConfigSetRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'SetReqAuthConfig');
    }

    /**
     * @param string $key1
     * @return $this
     */
    public function setKey1($key1)
    {
        $this->requestParameters['Key1'] = $key1;
        $this->queryParameters['Key1'] = $key1;

        return $this;
    }

    /**
     * @param string $key2
     * @return $this
     */
    public function setKey2($key2)
    {
        $this->requestParameters['Key2'] = $key2;
        $this->queryParameters['Key2'] = $key2;

        return $this;
    }

    /**
     * @param string $timeOut
     * @return $this
     */
    public function setTimeOut($timeOut)
    {
        $this->requestParameters['TimeOut'] = $timeOut;
        $this->queryParameters['TimeOut'] = $timeOut;

        return $this;
    }

    /**
     * @param string $authType
     * @return $this
     */
    public function setAuthType($authType)
    {
        $this->requestParameters['AuthType'] = $authType;
        $this->queryParameters['AuthType'] = $authType;

        return $this;
    }

    /**
     * @param string $authRemoteDesc
     * @return $this
     */
    public function setAuthRemoteDesc($authRemoteDesc)
    {
        $this->requestParameters['AuthRemoteDesc'] = $authRemoteDesc;
        $this->queryParameters['AuthRemoteDesc'] = $authRemoteDesc;

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
