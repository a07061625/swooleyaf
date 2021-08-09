<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDingTalk
 *
 * @method string getRuleActionName()
 * @method string getSourceIp()
 */
class DingTalkDescribeRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'DescribeDingTalk', 'vipaegis');
    }

    /**
     * @param string $ruleActionName
     *
     * @return $this
     */
    public function setRuleActionName($ruleActionName)
    {
        $this->requestParameters['RuleActionName'] = $ruleActionName;
        $this->queryParameters['RuleActionName'] = $ruleActionName;

        return $this;
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }
}
