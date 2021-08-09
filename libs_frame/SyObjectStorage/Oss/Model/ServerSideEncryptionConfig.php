<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class ServerSideEncryptionConfig
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see https://help.aliyun.com/document_detail/117914.htm
 */
class ServerSideEncryptionConfig implements XmlConfig
{
    private $sseAlgorithm = '';
    private $kmsMasterKeyID = '';

    /**
     * ServerSideEncryptionConfig constructor.
     *
     * @param null $sseAlgorithm
     * @param null $kmsMasterKeyID
     */
    public function __construct($sseAlgorithm = null, $kmsMasterKeyID = null)
    {
        $this->sseAlgorithm = $sseAlgorithm;
        $this->kmsMasterKeyID = $kmsMasterKeyID;
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Parse ServerSideEncryptionConfig from the xml.
     *
     * @param string $strXml
     *
     * @throws OssException
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (!isset($xml->ApplyServerSideEncryptionByDefault)) {
            return;
        }
        foreach ($xml->ApplyServerSideEncryptionByDefault as $default) {
            foreach ($default as $key => $value) {
                if ('SSEAlgorithm' === $key) {
                    $this->sseAlgorithm = (string)$value;
                } elseif ('KMSMasterKeyID' === $key) {
                    $this->kmsMasterKeyID = (string)$value;
                }
            }

            break;
        }
    }

    /**
     * Serialize the object into xml string.
     *
     * @return string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><ServerSideEncryptionRule></ServerSideEncryptionRule>');
        $default = $xml->addChild('ApplyServerSideEncryptionByDefault');
        if (isset($this->sseAlgorithm)) {
            $default->addChild('SSEAlgorithm', $this->sseAlgorithm);
        }
        if (isset($this->kmsMasterKeyID)) {
            $default->addChild('KMSMasterKeyID', $this->kmsMasterKeyID);
        }

        return $xml->asXML();
    }

    /**
     * @return string
     */
    public function getSSEAlgorithm()
    {
        return $this->sseAlgorithm;
    }

    /**
     * @return string
     */
    public function getKMSMasterKeyID()
    {
        return $this->kmsMasterKeyID;
    }
}
