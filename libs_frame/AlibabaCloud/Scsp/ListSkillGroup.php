<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getChannelType()
 * @method $this withChannelType($value)
 */
class ListSkillGroup extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
