<?php

namespace AliOpen\DomainIntl;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveTaskForUpdatingRegistrantInfoByRegistrantProfileID
 *
 * @method string getUserClientIp()
 * @method string getRegistrantProfileId()
 * @method array getDomainNames()
 * @method string getTransferOutProhibited()
 * @method string getLang()
 */
class SaveTaskForUpdatingRegistrantInfoByRegistrantProfileIDRequest extends RpcAcsRequest
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
        parent::__construct('Domain-intl', '2017-12-18', 'SaveTaskForUpdatingRegistrantInfoByRegistrantProfileID', 'domain');
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $registrantProfileId
     *
     * @return $this
     */
    public function setRegistrantProfileId($registrantProfileId)
    {
        $this->requestParameters['RegistrantProfileId'] = $registrantProfileId;
        $this->queryParameters['RegistrantProfileId'] = $registrantProfileId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDomainNames(array $domainName)
    {
        $this->requestParameters['DomainNames'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->queryParameters['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $transferOutProhibited
     *
     * @return $this
     */
    public function setTransferOutProhibited($transferOutProhibited)
    {
        $this->requestParameters['TransferOutProhibited'] = $transferOutProhibited;
        $this->queryParameters['TransferOutProhibited'] = $transferOutProhibited;

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
