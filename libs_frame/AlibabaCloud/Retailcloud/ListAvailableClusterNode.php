<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getClusterInstanceId()
 * @method $this withClusterInstanceId($value)
 */
class ListAvailableClusterNode extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
