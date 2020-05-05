<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetVodDomainCertificate
 * @method string getSSLProtocol()
 * @method string getSecurityToken()
 * @method string getSSLPri()
 * @method string getCertName()
 * @method string getDomainName()
 * @method string getOwnerId()
 * @method string getSSLPub()
 * @method string getRegion()
 */
class VodDomainCertificateSetRequest extends RpcAcsRequest
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
        parent::__construct('vod', '2017-03-21', 'SetVodDomainCertificate', 'vod');
    }

    /**
     * @param string $sSLProtocol
     * @return $this
     */
    public function setSSLProtocol($sSLProtocol)
    {
        $this->requestParameters['SSLProtocol'] = $sSLProtocol;
        $this->queryParameters['SSLProtocol'] = $sSLProtocol;

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

    /**
     * @param string $sSLPri
     * @return $this
     */
    public function setSSLPri($sSLPri)
    {
        $this->requestParameters['SSLPri'] = $sSLPri;
        $this->queryParameters['SSLPri'] = $sSLPri;

        return $this;
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
     * @param string $domainName
     * @return $this
     */
    public function setDomainName($domainName)
    {
        $this->requestParameters['DomainName'] = $domainName;
        $this->queryParameters['DomainName'] = $domainName;

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
     * @param string $sSLPub
     * @return $this
     */
    public function setSSLPub($sSLPub)
    {
        $this->requestParameters['SSLPub'] = $sSLPub;
        $this->queryParameters['SSLPub'] = $sSLPub;

        return $this;
    }

    /**
     * @param string $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->requestParameters['Region'] = $region;
        $this->queryParameters['Region'] = $region;

        return $this;
    }
}
