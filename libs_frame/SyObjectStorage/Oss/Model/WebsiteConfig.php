<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class WebsiteConfig
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/bucket/PutBucketWebsite.html
 */
class WebsiteConfig implements XmlConfig
{
    private $indexDocument = '';
    private $errorDocument = '';

    /**
     * WebsiteConfig constructor.
     *
     * @param string $indexDocument
     * @param string $errorDocument
     */
    public function __construct($indexDocument = '', $errorDocument = '')
    {
        $this->indexDocument = $indexDocument;
        $this->errorDocument = $errorDocument;
    }

    /**
     * @param string $strXml
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (isset($xml->IndexDocument, $xml->IndexDocument->Suffix)) {
            $this->indexDocument = (string)($xml->IndexDocument->Suffix);
        }
        if (isset($xml->ErrorDocument, $xml->ErrorDocument->Key)) {
            $this->errorDocument = (string)($xml->ErrorDocument->Key);
        }
    }

    /**
     * Serialize the WebsiteConfig object into xml string.
     *
     * @return string
     *
     * @throws OssException
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><WebsiteConfiguration></WebsiteConfiguration>');
        $index_document_part = $xml->addChild('IndexDocument');
        $error_document_part = $xml->addChild('ErrorDocument');
        $index_document_part->addChild('Suffix', $this->indexDocument);
        $error_document_part->addChild('Key', $this->errorDocument);

        return $xml->asXML();
    }

    /**
     * @return string
     */
    public function getIndexDocument()
    {
        return $this->indexDocument;
    }

    /**
     * @return string
     */
    public function getErrorDocument()
    {
        return $this->errorDocument;
    }
}
