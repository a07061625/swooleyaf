<?php

namespace AliOpen\TradeMark;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryMonitorKeywords
 *
 * @method array getKeywordss()
 * @method string getRuleType()
 */
class QueryMonitorKeywordsRequest extends RpcAcsRequest
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
        parent::__construct('Trademark', '2018-07-24', 'QueryMonitorKeywords', 'trademark');
    }

    /**
     * @return $this
     */
    public function setKeywordss(array $keywords)
    {
        $this->requestParameters['Keywordss'] = $keywords;
        foreach ($keywords as $i => $iValue) {
            $this->queryParameters['Keywords.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $ruleType
     *
     * @return $this
     */
    public function setRuleType($ruleType)
    {
        $this->requestParameters['RuleType'] = $ruleType;
        $this->queryParameters['RuleType'] = $ruleType;

        return $this;
    }
}
