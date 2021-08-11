<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getDeletionTaskId()
 * @method $this withDeletionTaskId($value)
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getSPIRegionId()
 * @method $this withSPIRegionId($value)
 * @method string getRoleArn()
 * @method $this withRoleArn($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class CheckSLRDelete extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
