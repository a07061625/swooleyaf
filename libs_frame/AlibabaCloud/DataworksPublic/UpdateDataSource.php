<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getDataSourceId()
 * @method $this withDataSourceId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getContent()
 * @method $this withContent($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class UpdateDataSource extends Rpc
{
    /** @var string */
    public $method = 'PUT';
}
