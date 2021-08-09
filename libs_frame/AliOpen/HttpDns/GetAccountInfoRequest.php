<?php

namespace AliOpen\HttpDns;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetAccountInfo
 */
class GetAccountInfoRequest extends RpcAcsRequest
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
        parent::__construct('Httpdns', '2016-02-01', 'GetAccountInfo', 'httpdns');
    }
}
