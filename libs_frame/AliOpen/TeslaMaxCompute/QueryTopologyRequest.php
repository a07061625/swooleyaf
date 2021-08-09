<?php

namespace AliOpen\TeslaMaxCompute;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryTopology
 */
class QueryTopologyRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('TeslaMaxCompute', '2018-01-04', 'QueryTopology', 'teslamaxcompute');
    }
}
