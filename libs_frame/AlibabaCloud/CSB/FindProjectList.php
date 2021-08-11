<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 */
class FindProjectList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
