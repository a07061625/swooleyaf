<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteEventRules
 *
 * @method array getRuleNamess()
 */
class DeleteEventRulesRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Cms',
            '2019-01-01',
            'DeleteEventRules',
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
