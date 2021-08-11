<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDataSourceType()
 * @method $this withDataSourceType($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getTableGuid()
 * @method $this withTableGuid($value)
 * @method string getDatabaseName()
 * @method $this withDatabaseName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getTableName()
 * @method $this withTableName($value)
 */
class GetMetaTableColumn extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
