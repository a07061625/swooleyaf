<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getConnectionId()
 * @method $this withConnectionId($value)
 * @method string getContent()
 * @method $this withContent($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class UpdateConnection extends Rpc
{
    /** @var string */
    public $method = 'PUT';
}
