<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of EnableMetricRules
 *
 * @method array getRuleIds()
 */
class EnableMetricRulesRequest extends RpcAcsRequest
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
            'EnableMetricRules',
            'cms'
        );
    }

    /**
     * @return $this
     */
    public function setRuleIds(array $ruleId)
    {
        $this->requestParameters['RuleIds'] = $ruleId;
        foreach ($ruleId as $i => $iValue) {
            $this->queryParameters['RuleId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
