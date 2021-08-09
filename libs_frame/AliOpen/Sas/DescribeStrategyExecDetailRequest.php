<?php

namespace AliOpen\Sas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeStrategyExecDetail
 * @method string getSourceIp()
 * @method string getStrategyId()
 */
class DescribeStrategyExecDetailRequest extends RpcAcsRequest
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
        parent::__construct('Sas', '2018-12-03', 'DescribeStrategyExecDetail', 'sas');
    }

    /**
     * @param string $sourceIp
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $strategyId
     * @return $this
     */
    public function setStrategyId($strategyId)
    {
        $this->requestParameters['StrategyId'] = $strategyId;
        $this->queryParameters['StrategyId'] = $strategyId;

        return $this;
    }
}
