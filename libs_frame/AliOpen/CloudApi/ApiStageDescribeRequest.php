<?php
namespace AliOpen\CloudApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeApiStage
 * @method string getGroupId()
 * @method string getSecurityToken()
 * @method string getStageId()
 */
class ApiStageDescribeRequest extends RpcAcsRequest
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
        parent::__construct('CloudAPI', '2016-07-14', 'DescribeApiStage', 'apigateway');
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
     * @param string $stageId
     * @return $this
     */
    public function setStageId($stageId)
    {
        $this->requestParameters['StageId'] = $stageId;
        $this->queryParameters['StageId'] = $stageId;

        return $this;
    }
}
