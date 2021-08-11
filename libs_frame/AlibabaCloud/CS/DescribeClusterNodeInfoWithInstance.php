<?php

namespace AlibabaCloud\CS;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getToken()
 * @method $this withToken($value)
 */
class DescribeClusterNodeInfoWithInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/token/[Token]/instance/[InstanceId]/node_info';
}
