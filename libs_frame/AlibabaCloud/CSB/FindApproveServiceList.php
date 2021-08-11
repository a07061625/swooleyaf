<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getApproveLevel()
 * @method $this withApproveLevel($value)
 * @method string getShowDelService()
 * @method $this withShowDelService($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getAlias()
 * @method $this withAlias($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class FindApproveServiceList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
