<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getPodName()
 * @method $this withPodName($value)
 * @method string getEnvId()
 * @method $this withEnvId($value)
 */
class DescribeJobLog extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
