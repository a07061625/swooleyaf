<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getShowDelService()
 * @method $this withShowDelService($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getCasShowType()
 * @method $this withCasShowType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getAlias()
 * @method $this withAlias($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class FindServiceList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
