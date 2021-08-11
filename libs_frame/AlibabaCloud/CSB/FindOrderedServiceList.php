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
 * @method string getAccessKey()
 * @method $this withAccessKey($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method string getServiceId()
 * @method $this withServiceId($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class FindOrderedServiceList extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
