<?php

namespace AliOpen\Scdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BatchDeleteScdnDomainConfigs
 *
 * @method string getFunctionNames()
 * @method string getDomainNames()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 */
class BatchDeleteScdnDomainConfigsRequest extends RpcAcsRequest
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
        parent::__construct('scdn', '2017-11-15', 'BatchDeleteScdnDomainConfigs');
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
     * @param string $domainNames
     *
     * @return $this
     */
    public function setDomainNames($domainNames)
    {
        $this->requestParameters['DomainNames'] = $domainNames;
        $this->queryParameters['DomainNames'] = $domainNames;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

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
