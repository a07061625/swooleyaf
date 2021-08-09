<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class LiveChannelInfo
 *
 * @package SyObjectStorage\Oss\Model
 */
class LiveChannelInfo implements XmlConfig
{
    private $name;
    private $description;
    private $publishUrls;
    private $playUrls;
    private $status;
    private $lastModified;

    public function __construct($name = null, $description = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->publishUrls = [];
        $this->playUrls = [];
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPublishUrls()
    {
        return $this->publishUrls;
    }

    public function getPlayUrls()
    {
        return $this->playUrls;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function parseFromXmlNode($xml)
    {
        if (isset($xml->Name)) {
            $this->name = (string)($xml->Name);
        }

        if (isset($xml->Description)) {
            $this->description = (string)($xml->Description);
        }

        if (isset($xml->Status)) {
            $this->status = (string)($xml->Status);
        }

        if (isset($xml->LastModified)) {
            $this->lastModified = (string)($xml->LastModified);
        }

        if (isset($xml->PublishUrls)) {
            foreach ($xml->PublishUrls as $url) {
                $this->publishUrls[] = (string)($url->Url);
            }
        }

        if (isset($xml->PlayUrls)) {
            foreach ($xml->PlayUrls as $url) {
                $this->playUrls[] = (string)($url->Url);
            }
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
