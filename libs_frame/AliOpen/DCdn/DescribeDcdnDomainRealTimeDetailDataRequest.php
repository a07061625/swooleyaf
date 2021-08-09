<?php

namespace AliOpen\DCdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDcdnDomainRealTimeDetailData
 *
 * @method string getLocationNameEn()
 * @method string getStartTime()
 * @method string getIspNameEn()
 * @method string getMerge()
 * @method string getDomainName()
 * @method string getEndTime()
 * @method string getMergeLocIsp()
 * @method string getOwnerId()
 * @method string getField()
 */
class DescribeDcdnDomainRealTimeDetailDataRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dcdn', '2018-01-15', 'DescribeDcdnDomainRealTimeDetailData');
    }

    /**
     * @param string $locationNameEn
     *
     * @return $this
     */
    public function setLocationNameEn($locationNameEn)
    {
        $this->requestParameters['LocationNameEn'] = $locationNameEn;
        $this->queryParameters['LocationNameEn'] = $locationNameEn;

        return $this;
    }

    /**
     * @param string $startTime
     *
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->requestParameters['StartTime'] = $startTime;
        $this->queryParameters['StartTime'] = $startTime;

        return $this;
    }

    /**
     * @param string $ispNameEn
     *
     * @return $this
     */
    public function setIspNameEn($ispNameEn)
    {
        $this->requestParameters['IspNameEn'] = $ispNameEn;
        $this->queryParameters['IspNameEn'] = $ispNameEn;

        return $this;
    }

    /**
     * @param string $merge
     *
     * @return $this
     */
    public function setMerge($merge)
    {
        $this->requestParameters['Merge'] = $merge;
        $this->queryParameters['Merge'] = $merge;

        return $this;
    }

    /**
     * @param string $domainName
     *
     * @return $this
     */
    public function setDomainName($domainName)
    {
        $this->requestParameters['DomainName'] = $domainName;
        $this->queryParameters['DomainName'] = $domainName;

        return $this;
    }

    /**
     * @param string $endTime
     *
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->requestParameters['EndTime'] = $endTime;
        $this->queryParameters['EndTime'] = $endTime;

        return $this;
    }

    /**
     * @param string $mergeLocIsp
     *
     * @return $this
     */
    public function setMergeLocIsp($mergeLocIsp)
    {
        $this->requestParameters['MergeLocIsp'] = $mergeLocIsp;
        $this->queryParameters['MergeLocIsp'] = $mergeLocIsp;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $field
     *
     * @return $this
     */
    public function setField($field)
    {
        $this->requestParameters['Field'] = $field;
        $this->queryParameters['Field'] = $field;

        return $this;
    }
}
