<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class GetLiveChannelInfo
 *
 * @package SyObjectStorage\Oss\Model
 */
class GetLiveChannelInfo implements XmlConfig
{
    private $description;
    private $status;
    private $type;
    private $fragDuration;
    private $fragCount;
    private $playlistName;

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFragDuration()
    {
        return $this->fragDuration;
    }

    public function getFragCount()
    {
        return $this->fragCount;
    }

    public function getPlayListName()
    {
        return $this->playlistName;
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);

        $this->description = (string)($xml->Description);
        $this->status = (string)($xml->Status);

        if (isset($xml->Target)) {
            foreach ($xml->Target as $target) {
                $this->type = (string)($target->Type);
                $this->fragDuration = (string)($target->FragDuration);
                $this->fragCount = (string)($target->FragCount);
                $this->playlistName = (string)($target->PlaylistName);
            }
        }
    }

    public function serializeToXml()
    {
        throw new OssException('Not implemented.');
    }
}
