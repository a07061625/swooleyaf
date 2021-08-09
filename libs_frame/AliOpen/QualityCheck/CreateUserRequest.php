<?php

namespace AliOpen\QualityCheck;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateUser
 * @method string getResourceOwnerId()
 * @method string getJsonStr()
 */
class CreateUserRequest extends RpcAcsRequest
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
        parent::__construct('Qualitycheck', '2019-01-15', 'CreateUser');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $jsonStr
     * @return $this
     */
    public function setJsonStr($jsonStr)
    {
        $this->requestParameters['JsonStr'] = $jsonStr;
        $this->queryParameters['JsonStr'] = $jsonStr;

        return $this;
    }
}
