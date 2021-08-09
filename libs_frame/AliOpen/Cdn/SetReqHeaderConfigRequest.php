<?php

namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetReqHeaderConfig
 *
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 * @method string getConfigId()
 * @method string getValue()
 * @method string getKey()
 */
class SetReqHeaderConfigRequest extends RpcAcsRequest
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
        parent::__construct(
            'Cdn',
            '2018-05-10',
            'SetReqHeaderConfig'
        );
    }

    /**
     * @param string $domainName
     *
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
     * @param string $securityToken
     *
     * @return $this
     */
    public function setSecurityToken($securityToken)
    {
        $this->requestParameters['SecurityToken'] = $securityToken;
        $this->queryParameters['SecurityToken'] = $securityToken;

        return $this;
    }

    /**
     * @param string $configId
     *
     * @return $this
     */
    public function setConfigId($configId)
    {
        $this->requestParameters['ConfigId'] = $configId;
        $this->queryParameters['ConfigId'] = $configId;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->requestParameters['Value'] = $value;
        $this->queryParameters['Value'] = $value;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->requestParameters['Key'] = $key;
        $this->queryParameters['Key'] = $key;

        return $this;
    }
}
