<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getBusinessCode()
 * @method $this withBusinessCode($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 */
class ListCluster extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
