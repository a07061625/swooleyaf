<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCdnUserBillPrediction
 * @method string getStartTime()
 * @method string getDimension()
 * @method string getArea()
 * @method string getEndTime()
 * @method string getOwnerId()
 */
class CdnUserBillPredictionDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'DescribeCdnUserBillPrediction');
    }

    /**
     * @param string $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $dimension
     * @return $this
     */
    public function setDimension($dimension)
    {
        $this->requestParameters['Dimension'] = $dimension;
        $this->queryParameters['Dimension'] = $dimension;

        return $this;
    }

    /**
     * @param string $area
     * @return $this
     */
    public function setArea($area)
    {
        $this->requestParameters['Area'] = $area;
        $this->queryParameters['Area'] = $area;

        return $this;
    }

    /**
     * @param string $endTime
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
