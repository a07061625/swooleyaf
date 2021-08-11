<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getName()
 * @method $this withName($value)
 */
class GetSensitiveData extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
