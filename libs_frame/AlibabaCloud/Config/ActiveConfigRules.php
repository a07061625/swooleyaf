<?php

namespace AlibabaCloud\Config;

/**
 * @method string getConfigRuleIds()
 * @method $this withConfigRuleIds($value)
 */
class ActiveConfigRules extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
