<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class InitiateWormConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class InitiateWormConfig implements XmlConfig
{
    private $day = 0;

    /**
     * InitiateWormConfig constructor.
     *
     * @param null $day
     */
    public function __construct($day = null)
    {
        $this->day = $day;
    }

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Parse InitiateWormConfig from the xml.
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
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><InitiateWormConfiguration></InitiateWormConfiguration>');
        if (isset($this->day)) {
            $xml->addChild('RetentionPeriodInDays', $this->day);
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
}
