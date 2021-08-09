<?php

namespace AliOpen\QualityCheck;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetUserInfo
 *
 * @method string getResourceOwnerId()
 */
class GetUserInfoRequest extends RpcAcsRequest
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
        parent::__construct('Qualitycheck', '2019-01-15', 'GetUserInfo');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }
}
