<?php

namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListFlowClusterAll
 */
class ListFlowClusterAllRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'ListFlowClusterAll', 'emr');
    }
}
