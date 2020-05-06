<?php
namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ResetAppCode
 * @method string getSecurityToken()
 * @method string getAppCode()
 */
class AppCodeResetRequest extends RpcAcsRequest
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
        parent::__construct('CloudAPI', '2016-07-14', 'ResetAppCode', 'apigateway');
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
     * @param string $appCode
     * @return $this
     */
    public function setAppCode($appCode)
    {
        $this->requestParameters['AppCode'] = $appCode;
        $this->queryParameters['AppCode'] = $appCode;

        return $this;
    }
}
