<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getAlias()
 * @method $this withAlias($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class FindOrderableList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
