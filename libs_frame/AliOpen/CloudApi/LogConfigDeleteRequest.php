<?php
namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteLogConfig
 * @method string getLogType()
 * @method string getSecurityToken()
 */
class LogConfigDeleteRequest extends RpcAcsRequest
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
        parent::__construct('CloudAPI', '2016-07-14', 'DeleteLogConfig', 'apigateway');
    }

    /**
     * @param string $logType
     * @return $this
     */
    public function setLogType($logType)
    {
        $this->requestParameters['LogType'] = $logType;
        $this->queryParameters['LogType'] = $logType;

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
}
