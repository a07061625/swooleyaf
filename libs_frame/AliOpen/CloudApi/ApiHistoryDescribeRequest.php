<?php
namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeApiHistory
 * @method string getStageName()
 * @method string getGroupId()
 * @method string getSecurityToken()
 * @method string getApiId()
 * @method string getHistoryVersion()
 */
class ApiHistoryDescribeRequest extends RpcAcsRequest
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
        parent::__construct('CloudAPI', '2016-07-14', 'DescribeApiHistory', 'apigateway');
    }

    /**
     * @param string $stageName
     * @return $this
     */
    public function setStageName($stageName)
    {
        $this->requestParameters['StageName'] = $stageName;
        $this->queryParameters['StageName'] = $stageName;

        return $this;
    }

    /**
     * @param string $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

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
     * @param string $apiId
     * @return $this
     */
    public function setApiId($apiId)
    {
        $this->requestParameters['ApiId'] = $apiId;
        $this->queryParameters['ApiId'] = $apiId;

        return $this;
    }

    /**
     * @param string $historyVersion
     * @return $this
     */
    public function setHistoryVersion($historyVersion)
    {
        $this->requestParameters['HistoryVersion'] = $historyVersion;
        $this->queryParameters['HistoryVersion'] = $historyVersion;

        return $this;
    }
}
