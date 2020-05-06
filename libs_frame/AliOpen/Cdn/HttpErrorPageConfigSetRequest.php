<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetHttpErrorPageConfig
 * @method string getPageUrl()
 * @method string getErrorCode()
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method string getConfigId()
 */
class HttpErrorPageConfigSetRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Cdn', '2018-05-10', 'SetHttpErrorPageConfig');
    }

    /**
     * @param string $pageUrl
     * @return $this
     */
    public function setPageUrl($pageUrl)
    {
        $this->requestParameters['PageUrl'] = $pageUrl;
        $this->queryParameters['PageUrl'] = $pageUrl;

        return $this;
    }

    /**
     * @param string $errorCode
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->requestParameters['ErrorCode'] = $errorCode;
        $this->queryParameters['ErrorCode'] = $errorCode;

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
     * @param string $configId
     * @return $this
     */
    public function setConfigId($configId)
    {
        $this->requestParameters['ConfigId'] = $configId;
        $this->queryParameters['ConfigId'] = $configId;

        return $this;
    }
}
