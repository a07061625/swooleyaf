<?php

namespace AlibabaCloud\Privatelink;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEndpointId()
 * @method $this withEndpointId($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 */
class AttachSecurityGroupToVpcEndpoint extends Rpc
{
    /** @var string */
    public $scheme = 'http';
}
