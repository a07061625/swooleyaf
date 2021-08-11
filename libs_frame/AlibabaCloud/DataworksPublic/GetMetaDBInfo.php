<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDataSourceType()
 * @method $this withDataSourceType($value)
 * @method string getDatabaseName()
 * @method $this withDatabaseName($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getAppGuid()
 * @method $this withAppGuid($value)
 */
class GetMetaDBInfo extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
