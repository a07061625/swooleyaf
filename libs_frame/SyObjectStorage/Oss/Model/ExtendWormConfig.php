<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class ExtendWormConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class ExtendWormConfig implements XmlConfig
{
    private $day = 0;

    /**
     * ExtendWormConfig constructor.
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
     * Parse ExtendWormConfig from the xml.
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
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><ExtendWormConfiguration></ExtendWormConfiguration>');
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
