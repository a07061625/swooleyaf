<?php
namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of DescribeEventRuleTargetList
 *
 * @method string getRuleName()
 */
class DescribeEventRuleTargetListRequest extends RpcAcsRequest
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
            'DescribeEventRuleTargetList',
            'cms'
        );
    }

    /**
     * @param string $ruleName
     *
     * @return $this
     */
    public function setRuleName($ruleName)
    {
        $this->requestParameters['RuleName'] = $ruleName;
        $this->queryParameters['RuleName'] = $ruleName;

        return $this;
    }
}
