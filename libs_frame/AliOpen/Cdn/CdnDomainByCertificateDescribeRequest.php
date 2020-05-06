<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeCdnDomainByCertificate
 * @method string getOwnerId()
 * @method string getSSLPub()
 */
class CdnDomainByCertificateDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'DescribeCdnDomainByCertificate');
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
}
