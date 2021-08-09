<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of EnableEventRules
 *
 * @method array getRuleNamess()
 */
class EnableEventRulesRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Cms',
            '2019-01-01',
            'EnableEventRules',
            'cms'
        );
    }

    /**
     * @return $this
     */
    public function setRuleNamess(array $ruleNames)
    {
        $this->requestParameters['RuleNamess'] = $ruleNames;
        foreach ($ruleNames as $i => $iValue) {
            $this->queryParameters['RuleNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
