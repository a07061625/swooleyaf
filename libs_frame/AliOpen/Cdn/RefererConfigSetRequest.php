<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetRefererConfig
 * @method string getReferList()
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 * @method string getReferType()
 * @method string getDisableAst()
 * @method string getAllowEmpty()
 */
class RefererConfigSetRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'SetRefererConfig');
    }

    /**
     * @param string $referList
     * @return $this
     */
    public function setReferList($referList)
    {
        $this->requestParameters['ReferList'] = $referList;
        $this->queryParameters['ReferList'] = $referList;

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
     * @param string $referType
     * @return $this
     */
    public function setReferType($referType)
    {
        $this->requestParameters['ReferType'] = $referType;
        $this->queryParameters['ReferType'] = $referType;

        return $this;
    }

    /**
     * @param string $disableAst
     * @return $this
     */
    public function setDisableAst($disableAst)
    {
        $this->requestParameters['DisableAst'] = $disableAst;
        $this->queryParameters['DisableAst'] = $disableAst;

        return $this;
    }

    /**
     * @param string $allowEmpty
     * @return $this
     */
    public function setAllowEmpty($allowEmpty)
    {
        $this->requestParameters['AllowEmpty'] = $allowEmpty;
        $this->queryParameters['AllowEmpty'] = $allowEmpty;

        return $this;
    }
}
