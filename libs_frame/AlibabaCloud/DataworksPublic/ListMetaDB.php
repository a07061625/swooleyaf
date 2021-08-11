<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDataSourceType()
 * @method $this withDataSourceType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class ListMetaDB extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
