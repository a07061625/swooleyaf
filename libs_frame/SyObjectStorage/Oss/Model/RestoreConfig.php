<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class RestoreConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class RestoreConfig implements XmlConfig
{
    private $day = 1;
    private $tier = 'Standard';

    /**
     * RestoreConfig constructor.
     *
     * @param int  $day
     * @param null $tier
     */
    public function __construct($day, $tier = null)
    {
        $this->day = $day;
        $this->tier = $tier;
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Parse RestoreConfig from the xml.
     *
     * @param string $strXml
     *
     * @throws OssException
     */
    public function parseFromXml($strXml)
    {
        throw new OssException('Not implemented.');
    }

    /**
     * Serialize the object into xml string.
     *
     * @return string
     */
    public function serializeToXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><RestoreRequest></RestoreRequest>');
        $xml->addChild('Days', (string)($this->day));
        if (isset($this->tier)) {
            $xml_param = $xml->addChild('JobParameters');
            $xml_param->addChild('Tier', $this->tier);
        }

        return $xml->asXML();
    }

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getTier()
    {
        return $this->tier;
    }
}
