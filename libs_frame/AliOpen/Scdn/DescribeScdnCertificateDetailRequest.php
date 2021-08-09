<?php

namespace AliOpen\Scdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeScdnCertificateDetail
 * @method string getCertName()
 * @method string getOwnerId()
 * @method string getSecurityToken()
 */
class DescribeScdnCertificateDetailRequest extends RpcAcsRequest
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
        parent::__construct('scdn', '2017-11-15', 'DescribeScdnCertificateDetail');
    }

    /**
     * @param string $certName
     * @return $this
     */
    public function setCertName($certName)
    {
        $this->requestParameters['CertName'] = $certName;
        $this->queryParameters['CertName'] = $certName;

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

    /**
     * @param string $securityToken
     * @return $this
     */
    public function setSecurityToken($securityToken)
    {
        $this->requestParameters['SecurityToken'] = $securityToken;
        $this->queryParameters['SecurityToken'] = $securityToken;

        return $this;
    }
}
