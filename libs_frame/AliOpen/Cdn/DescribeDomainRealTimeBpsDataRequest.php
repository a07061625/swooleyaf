<?php

namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDomainRealTimeBpsData
 *
 * @method string getLocationNameEn()
 * @method string getIspNameEn()
 * @method string getStartTime()
 * @method string getDomainName()
 * @method string getEndTime()
 * @method string getOwnerId()
 */
class DescribeDomainRealTimeBpsDataRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Cdn',
            '2018-05-10',
            'DescribeDomainRealTimeBpsData'
        );
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
}
