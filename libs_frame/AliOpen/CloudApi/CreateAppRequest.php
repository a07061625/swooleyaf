<?php

namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateApp
 *
 * @method string getDescription()
 * @method string getAppName()
 * @method string getSecurityToken()
 * @method array getTags()
 */
class CreateAppRequest extends RpcAcsRequest
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
            'CloudAPI',
            '2016-07-14',
            'CreateApp',
            'apigateway'
        );
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $appName
     *
     * @return $this
     */
    public function setAppName($appName)
    {
        $this->requestParameters['AppName'] = $appName;
        $this->queryParameters['AppName'] = $appName;

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
     * @return $this
     */
    public function setTags(array $tag)
    {
        $this->requestParameters['Tags'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
