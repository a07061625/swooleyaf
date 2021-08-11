<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 */
class FindProjectStatisticalData extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
