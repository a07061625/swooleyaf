<?php

namespace AliOpen\Scdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OpenScdnService
 *
 * @method string getStartDate()
 * @method string getCcProtection()
 * @method string getSecurityToken()
 * @method string getProtectType()
 * @method string getDDoSBasic()
 * @method string getBandwidth()
 * @method string getDomainCount()
 * @method string getOwnerId()
 * @method string getEndDate()
 * @method string getElasticProtection()
 */
class OpenScdnServiceRequest extends RpcAcsRequest
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
        parent::__construct('scdn', '2017-11-15', 'OpenScdnService');
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
     * @param string $ccProtection
     *
     * @return $this
     */
    public function setCcProtection($ccProtection)
    {
        $this->requestParameters['CcProtection'] = $ccProtection;
        $this->queryParameters['CcProtection'] = $ccProtection;

        return $this;
    }

    /**
     * @param string $securityToken
     *
     * @return $this
     */
    public function setSecurityToken($securityToken)
    {
        $this->requestParameters['SecurityToken'] = $securityToken;
        $this->queryParameters['SecurityToken'] = $securityToken;

        return $this;
    }

    /**
     * @param string $protectType
     *
     * @return $this
     */
    public function setProtectType($protectType)
    {
        $this->requestParameters['ProtectType'] = $protectType;
        $this->queryParameters['ProtectType'] = $protectType;

        return $this;
    }

    /**
     * @param string $dDoSBasic
     *
     * @return $this
     */
    public function setDDoSBasic($dDoSBasic)
    {
        $this->requestParameters['DDoSBasic'] = $dDoSBasic;
        $this->queryParameters['DDoSBasic'] = $dDoSBasic;

        return $this;
    }

    /**
     * @param string $bandwidth
     *
     * @return $this
     */
    public function setBandwidth($bandwidth)
    {
        $this->requestParameters['Bandwidth'] = $bandwidth;
        $this->queryParameters['Bandwidth'] = $bandwidth;

        return $this;
    }

    /**
     * @param string $domainCount
     *
     * @return $this
     */
    public function setDomainCount($domainCount)
    {
        $this->requestParameters['DomainCount'] = $domainCount;
        $this->queryParameters['DomainCount'] = $domainCount;

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
     * @param string $elasticProtection
     *
     * @return $this
     */
    public function setElasticProtection($elasticProtection)
    {
        $this->requestParameters['ElasticProtection'] = $elasticProtection;
        $this->queryParameters['ElasticProtection'] = $elasticProtection;

        return $this;
    }
}
