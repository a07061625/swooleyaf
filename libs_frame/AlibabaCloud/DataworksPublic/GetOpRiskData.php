<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDate()
 * @method $this withDate($value)
 * @method string getRiskType()
 * @method $this withRiskType($value)
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getName()
 * @method $this withName($value)
 */
class GetOpRiskData extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
