<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryBillToOSSSubscription
 */
class QueryBillToOSSSubscriptionRequest extends RpcAcsRequest
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
        parent::__construct('BssOpenApi', '2017-12-14', 'QueryBillToOSSSubscription', 'BssOpenApi');
    }
}
