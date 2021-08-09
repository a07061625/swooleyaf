<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class LiveChannelListInfo
 *
 * The data returned by ListBucketLiveChannels
 *
 * @package SyObjectStorage\Oss\Model
 *
 * @see http://help.aliyun.com/document_detail/oss/api-reference/bucket/GetBucket.html
 */
class LiveChannelListInfo implements XmlConfig
{
    private $bucket = '';
    private $prefix = '';
    private $marker = '';
    private $nextMarker = '';
    private $maxKeys = 100;
    private $isTruncated = 'false';
    private $channelList = [];

    /**
     * @return string
     */
    public function getBucketName()
    {
        return $this->bucket;
    }

    public function setBucketName($name)
    {
        $this->bucket = $name;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getMarker()
    {
        return $this->marker;
    }

    /**
     * @return int
     */
    public function getMaxKeys()
    {
        return $this->maxKeys;
    }

    /**
     * @return mixed
     */
    public function getIsTruncated()
    {
        return $this->isTruncated;
    }

    /**
     * @return LiveChannelInfo[]
     */
    public function getChannelList()
    {
        return $this->channelList;
    }

    /**
     * @return string
     */
    public function getNextMarker()
    {
        return $this->nextMarker;
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);

        $this->prefix = (string)($xml->Prefix);
        $this->marker = (string)($xml->Marker);
        $this->maxKeys = (int)($xml->MaxKeys);
        $this->isTruncated = ('true' == (string)($xml->IsTruncated));
        $this->nextMarker = (string)($xml->NextMarker);

        if (isset($xml->LiveChannel)) {
            foreach ($xml->LiveChannel as $chan) {
                $channel = new LiveChannelInfo();
                $channel->parseFromXmlNode($chan);
                $this->channelList[] = $channel;
            }
        }
    }

    public function serializeToXml()
    {
        throw new OssException('Not implemented.');
    }
}
