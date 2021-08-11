<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDataSourceType()
 * @method $this withDataSourceType($value)
 * @method string getExtension()
 * @method $this withExtension($value)
 * @method string getTableGuid()
 * @method $this withTableGuid($value)
 * @method string getDatabaseName()
 * @method $this withDatabaseName($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getTableName()
 * @method $this withTableName($value)
 */
class GetMetaTableBasicInfo extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
