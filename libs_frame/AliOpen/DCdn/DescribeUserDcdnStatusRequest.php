<?php

namespace AliOpen\DCdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeUserDcdnStatus
 *
 * @method string getOwnerId()
 * @method string getSecurityToken()
 */
class DescribeUserDcdnStatusRequest extends RpcAcsRequest
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
        parent::__construct('dcdn', '2018-01-15', 'DescribeUserDcdnStatus');
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

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
}
