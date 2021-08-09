<?php

namespace AliOpen\Arms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListTraceApps
 */
class ListTraceAppsRequest extends RpcAcsRequest
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
        parent::__construct(
            'ARMS',
            '2019-08-08',
            'ListTraceApps',
            'arms'
        );
    }
}
