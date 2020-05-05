<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListSummaryApps
 */
class SummaryAppsListRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'ListSummaryApps');
    }
}
