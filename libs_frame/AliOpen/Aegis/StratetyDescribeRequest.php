<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeStratety
 *
 * @method string getSourceIp()
 * @method string getStrategyIds()
 * @method string getLang()
 */
class StratetyDescribeRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'DescribeStratety', 'vipaegis');
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

    /**
     * @param string $strategyIds
     *
     * @return $this
     */
    public function setStrategyIds($strategyIds)
    {
        $this->requestParameters['StrategyIds'] = $strategyIds;
        $this->queryParameters['StrategyIds'] = $strategyIds;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
