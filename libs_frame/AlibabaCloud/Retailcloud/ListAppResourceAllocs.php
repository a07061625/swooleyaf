<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getAppEnvId()
 * @method $this withAppEnvId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListAppResourceAllocs extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
