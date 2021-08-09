<?php

namespace AliOpen\LinkFace;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryFace
 *
 * @method string getUserId()
 */
class QueryFaceRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('LinkFace', '2018-07-20', 'QueryFace');
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
