<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getDataSourceType()
 * @method $this withDataSourceType($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getSubType()
 * @method $this withSubType($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListDataSources extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
