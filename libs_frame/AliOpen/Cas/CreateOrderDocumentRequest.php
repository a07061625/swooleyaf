<?php

namespace AliOpen\Cas;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateOrderDocument
 *
 * @method string getOssKey()
 * @method string getSourceIp()
 * @method string getOrderId()
 * @method string getDocumentType()
 * @method string getLang()
 * @method string getExtName()
 */
class CreateOrderDocumentRequest extends RpcAcsRequest
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
            'CreateOrderDocument',
            'cas_esign_fdd'
        );
    }

    /**
     * @param string $ossKey
     *
     * @return $this
     */
    public function setOssKey($ossKey)
    {
        $this->requestParameters['OssKey'] = $ossKey;
        $this->queryParameters['OssKey'] = $ossKey;

        return $this;
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
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->requestParameters['OrderId'] = $orderId;
        $this->queryParameters['OrderId'] = $orderId;

        return $this;
    }

    /**
     * @param string $documentType
     *
     * @return $this
     */
    public function setDocumentType($documentType)
    {
        $this->requestParameters['DocumentType'] = $documentType;
        $this->queryParameters['DocumentType'] = $documentType;

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

    /**
     * @param string $extName
     *
     * @return $this
     */
    public function setExtName($extName)
    {
        $this->requestParameters['ExtName'] = $extName;
        $this->queryParameters['ExtName'] = $extName;

        return $this;
    }
}
