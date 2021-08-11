<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getEnvName()
 * @method $this withEnvName($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListAppEnvironment extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
