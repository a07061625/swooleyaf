<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListAvailableFileSystemTypes
 */
class ListAvailableFileSystemTypesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListAvailableFileSystemTypes', 'ehs');
    }
}
