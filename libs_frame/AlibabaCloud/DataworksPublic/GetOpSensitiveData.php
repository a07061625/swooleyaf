<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDate()
 * @method $this withDate($value)
 * @method string getOpType()
 * @method $this withOpType($value)
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class GetOpSensitiveData extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
