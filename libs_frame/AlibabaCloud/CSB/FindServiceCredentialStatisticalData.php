<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getCredentialName()
 * @method $this withCredentialName($value)
 * @method string getServiceNameVersion()
 * @method $this withServiceNameVersion($value)
 */
class FindServiceCredentialStatisticalData extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /** @var string */
    public $method = 'GET';
}
