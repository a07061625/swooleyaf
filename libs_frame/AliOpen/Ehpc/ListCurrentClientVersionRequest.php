<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListCurrentClientVersion
 */
class ListCurrentClientVersionRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListCurrentClientVersion', 'ehs');
    }
}
