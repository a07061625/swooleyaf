<?php

namespace AlibabaCloud\Polardbx;

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class DescribeBackupSetList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
