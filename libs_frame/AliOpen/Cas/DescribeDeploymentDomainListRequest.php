<?php

namespace AliOpen\Cas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDeploymentDomainList
 *
 * @method string getSourceIp()
 * @method string getCertificateId()
 * @method string getCloudProduct()
 * @method string getLang()
 */
class DescribeDeploymentDomainListRequest extends RpcAcsRequest
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
            'cas',
            '2018-08-13',
            'DescribeDeploymentDomainList',
            'cas_esign_fdd'
        );
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
     * @param string $certificateId
     *
     * @return $this
     */
    public function setCertificateId($certificateId)
    {
        $this->requestParameters['CertificateId'] = $certificateId;
        $this->queryParameters['CertificateId'] = $certificateId;

        return $this;
    }

    /**
     * @param string $cloudProduct
     *
     * @return $this
     */
    public function setCloudProduct($cloudProduct)
    {
        $this->requestParameters['CloudProduct'] = $cloudProduct;
        $this->queryParameters['CloudProduct'] = $cloudProduct;

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
