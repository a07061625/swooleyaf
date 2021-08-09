<?php

namespace AliOpen\ArmsFinance;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of WhereInDimQuery
 *
 * @method string getWhereInKey()
 * @method array getMeasuress()
 * @method string getIntervalInSec()
 * @method string getDateStr()
 * @method string getIsDrillDown()
 * @method string getMinTime()
 * @method string getDatasetId()
 * @method array getWhereInValuess()
 * @method string getMaxTime()
 * @method array getDimensionss()
 */
class WhereInDimQueryRequest extends RpcAcsRequest
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
            'ARMS4FINANCE',
            '2017-11-30',
            'WhereInDimQuery',
            'arms4finance'
        );
    }

    /**
     * @param string $whereInKey
     *
     * @return $this
     */
    public function setWhereInKey($whereInKey)
    {
        $this->requestParameters['WhereInKey'] = $whereInKey;
        $this->queryParameters['WhereInKey'] = $whereInKey;

        return $this;
    }

    /**
     * @return $this
     */
    public function setMeasuress(array $value)
    {
        $this->requestParameters['Measuress'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['Measures.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $intervalInSec
     *
     * @return $this
     */
    public function setIntervalInSec($intervalInSec)
    {
        $this->requestParameters['IntervalInSec'] = $intervalInSec;
        $this->queryParameters['IntervalInSec'] = $intervalInSec;

        return $this;
    }

    /**
     * @param string $dateStr
     *
     * @return $this
     */
    public function setDateStr($dateStr)
    {
        $this->requestParameters['DateStr'] = $dateStr;
        $this->queryParameters['DateStr'] = $dateStr;

        return $this;
    }

    /**
     * @param string $isDrillDown
     *
     * @return $this
     */
    public function setIsDrillDown($isDrillDown)
    {
        $this->requestParameters['IsDrillDown'] = $isDrillDown;
        $this->queryParameters['IsDrillDown'] = $isDrillDown;

        return $this;
    }

    /**
     * @param string $minTime
     *
     * @return $this
     */
    public function setMinTime($minTime)
    {
        $this->requestParameters['MinTime'] = $minTime;
        $this->queryParameters['MinTime'] = $minTime;

        return $this;
    }

    /**
     * @param string $datasetId
     *
     * @return $this
     */
    public function setDatasetId($datasetId)
    {
        $this->requestParameters['DatasetId'] = $datasetId;
        $this->queryParameters['DatasetId'] = $datasetId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setWhereInValuess(array $value)
    {
        $this->requestParameters['WhereInValuess'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['WhereInValues.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $maxTime
     *
     * @return $this
     */
    public function setMaxTime($maxTime)
    {
        $this->requestParameters['MaxTime'] = $maxTime;
        $this->queryParameters['MaxTime'] = $maxTime;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDimensionss(array $value)
    {
        $this->requestParameters['Dimensionss'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['Dimensions.' . ($i + 1) . '.Value'] = $value[$i]['Value'];
            $this->queryParameters['Dimensions.' . ($i + 1) . '.Key'] = $value[$i]['Key'];
        }

        return $this;
    }
}
