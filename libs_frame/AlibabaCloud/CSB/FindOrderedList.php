<?php

namespace AlibabaCloud\CSB;

/**
 * @method string getProjectName()
 * @method $this withProjectName($value)
 * @method string getShowDelOrder()
 * @method $this withShowDelOrder($value)
 * @method string getCsbId()
 * @method $this withCsbId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getCredentialGroupName()
 * @method $this withCredentialGroupName($value)
 * @method string getAlias()
 * @method $this withAlias($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method string getServiceId()
 * @method $this withServiceId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class FindOrderedList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
