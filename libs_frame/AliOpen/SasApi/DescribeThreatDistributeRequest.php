<?php

namespace AliOpen\SasApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeThreatDistribute
 *
 * @method string getEndDate()
 * @method string getSourceIp()
 * @method string getHitDay()
 * @method string getStartDate()
 * @method string getApiType()
 */
class DescribeThreatDistributeRequest extends RpcAcsRequest
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
        parent::__construct('Sas-api', '2017-07-05', 'DescribeThreatDistribute', 'sas-api');
    }

    /**
     * @param string $endDate
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->requestParameters['EndDate'] = $endDate;
        $this->queryParameters['EndDate'] = $endDate;

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

    /**
     * @param string $hitDay
     *
     * @return $this
     */
    public function setHitDay($hitDay)
    {
        $this->requestParameters['HitDay'] = $hitDay;
        $this->queryParameters['HitDay'] = $hitDay;

        return $this;
    }

    /**
     * @param string $startDate
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->requestParameters['StartDate'] = $startDate;
        $this->queryParameters['StartDate'] = $startDate;

        return $this;
    }

    /**
     * @param string $apiType
     *
     * @return $this
     */
    public function setApiType($apiType)
    {
        $this->requestParameters['ApiType'] = $apiType;
        $this->queryParameters['ApiType'] = $apiType;

        return $this;
    }
}
