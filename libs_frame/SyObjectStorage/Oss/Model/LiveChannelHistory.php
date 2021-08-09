<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class LiveChannelHistory
 *
 * @package SyObjectStorage\Oss\Model
 */
class LiveChannelHistory implements XmlConfig
{
    private $startTime;
    private $endTime;
    private $remoteAddr;

    public function __construct()
    {
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    public function parseFromXmlNode($xml)
    {
        if (isset($xml->StartTime)) {
            $this->startTime = (string)($xml->StartTime);
        }

        if (isset($xml->EndTime)) {
            $this->endTime = (string)($xml->EndTime);
        }

        if (isset($xml->RemoteAddr)) {
            $this->remoteAddr = (string)($xml->RemoteAddr);
        }
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        $this->parseFromXmlNode($xml);
    }

    public function serializeToXml()
    {
        throw new OssException('Not implemented.');
    }
}
