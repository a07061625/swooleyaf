<?php

namespace AlibabaCloud\Config;

/**
 * @method string getConfigRuleId()
 * @method $this withConfigRuleId($value)
 * @method string getMultiAccount()
 * @method $this withMultiAccount($value)
 * @method string getMemberId()
 * @method $this withMemberId($value)
 */
class StartConfigRuleEvaluation extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
