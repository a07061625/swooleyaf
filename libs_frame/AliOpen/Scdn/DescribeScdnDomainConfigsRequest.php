<?php

namespace AliOpen\Scdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeScdnDomainConfigs
 *
 * @method string getFunctionNames()
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 */
class DescribeScdnDomainConfigsRequest extends RpcAcsRequest
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
        parent::__construct('scdn', '2017-11-15', 'DescribeScdnDomainConfigs');
    }

    /**
     * @param string $functionNames
     *
     * @return $this
     */
    public function setFunctionNames($functionNames)
    {
        $this->requestParameters['FunctionNames'] = $functionNames;
        $this->queryParameters['FunctionNames'] = $functionNames;

        return $this;
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
}
