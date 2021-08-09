<?php

namespace AliOpen\FinMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetCustomStatusInfo
 *
 * @method string getUserId()
 */
class GetCustomStatusInfoRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('finmall', '2018-07-23', 'GetCustomStatusInfo', 'finmall');
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

        return $this;
    }
}
