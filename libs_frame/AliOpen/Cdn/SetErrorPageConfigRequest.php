<?php

namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetErrorPageConfig
 *
 * @method string getPageType()
 * @method string getDomainName()
 * @method string getCustomPageUrl()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 */
class SetErrorPageConfigRequest extends RpcAcsRequest
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
            'SetErrorPageConfig'
        );
    }

    /**
     * @param string $pageType
     *
     * @return $this
     */
    public function setPageType($pageType)
    {
        $this->requestParameters['PageType'] = $pageType;
        $this->queryParameters['PageType'] = $pageType;

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
     * @param string $customPageUrl
     *
     * @return $this
     */
    public function setCustomPageUrl($customPageUrl)
    {
        $this->requestParameters['CustomPageUrl'] = $customPageUrl;
        $this->queryParameters['CustomPageUrl'] = $customPageUrl;

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
