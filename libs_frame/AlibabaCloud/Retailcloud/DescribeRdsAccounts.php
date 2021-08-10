<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 */
class DescribeRdsAccounts extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
