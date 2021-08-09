<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class VersioningConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class VersioningConfig implements XmlConfig
{
    private $status = '';

    /**
     * VersioningConfig constructor.
     *
     * @param null $status
     */
    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Parse VersioningConfig from the xml.
     *
     * @param string $strXml
     *
     * @throws OssException
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (isset($xml->Status)) {
            $this->status = (string)($xml->Status);
        }
    }

    /**
     * Serialize the object into xml string.
     *
     * @return string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><VersioningConfiguration></VersioningConfiguration>');
        if (isset($this->status)) {
            $xml->addChild('Status', $this->status);
        }

        return $xml->asXML();
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
