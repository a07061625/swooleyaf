<?php

namespace SyObjectStorage\Oss\Model;

use SyObjectStorage\Oss\Core\OssException;

/**
 * Class WormConfig
 *
 * @package SyObjectStorage\Oss\Model
 */
class WormConfig implements XmlConfig
{
    private $wormId = '';
    private $state = '';
    private $creationDate = '';
    private $day = 0;

    public function __toString()
    {
        return $this->serializeToXml();
    }

    /**
     * Parse WormConfig from the xml.
     *
     * @param string $strXml
     */
    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        if (isset($xml->WormId)) {
            $this->wormId = (string)($xml->WormId);
        }
        if (isset($xml->State)) {
            $this->state = (string)($xml->State);
        }
        if (isset($xml->RetentionPeriodInDays)) {
            $this->day = (int)($xml->RetentionPeriodInDays);
        }
        if (isset($xml->CreationDate)) {
            $this->creationDate = (string)($xml->CreationDate);
        }
    }

    /**
     * Serialize the object into xml string.
     *
     * @return string
     */
    public function serializeToXml()
    {
        throw new OssException('Not implemented.');
    }

    /**
     * @return string
     */
    public function getWormId()
    {
        return $this->wormId;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
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
    public function getCreationDate()
    {
        return $this->creationDate;
    }
}
