<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BatchSetLiveDomainConfigs
 * @method string getFunctions()
 * @method string getSecurityToken()
 * @method string getDomainNames()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class LiveDomainConfigsSetBatchRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'BatchSetLiveDomainConfigs', 'live');
    }

    /**
     * @param string $functions
     * @return $this
     */
    public function setFunctions($functions)
    {
        $this->requestParameters['Functions'] = $functions;
        $this->queryParameters['Functions'] = $functions;

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
     * @param string $domainNames
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
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
