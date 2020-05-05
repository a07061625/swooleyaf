<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AddLiveStreamTranscode
 * @method string getApp()
 * @method string getTemplate()
 * @method string getSecurityToken()
 * @method string getDomain()
 * @method string getOwnerId()
 */
class LiveStreamTranscodeAddRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'AddLiveStreamTranscode', 'live');
    }

    /**
     * @param string $app
     * @return $this
     */
    public function setApp($app)
    {
        $this->requestParameters['App'] = $app;
        $this->queryParameters['App'] = $app;

        return $this;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->requestParameters['Template'] = $template;
        $this->queryParameters['Template'] = $template;

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
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->requestParameters['Domain'] = $domain;
        $this->queryParameters['Domain'] = $domain;

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
