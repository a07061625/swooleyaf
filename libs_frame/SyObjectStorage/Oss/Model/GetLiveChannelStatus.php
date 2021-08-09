<?php

namespace SyObjectStorage\Oss\Model;

/**
 * Class GetLiveChannelStatus
 *
 * @package SyObjectStorage\Oss\Model
 */
class GetLiveChannelStatus implements XmlConfig
{
    private $status;
    private $connectedTime;
    private $remoteAddr;

    private $videoWidth;
    private $videoHeight;
    private $videoFrameRate;
    private $videoBandwidth;
    private $videoCodec;

    private $audioBandwidth;
    private $audioSampleRate;
    private $audioCodec;

    public function getStatus()
    {
        return $this->status;
    }

    public function getConnectedTime()
    {
        return $this->connectedTime;
    }

    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    public function getVideoWidth()
    {
        return $this->videoWidth;
    }

    public function getVideoHeight()
    {
        return $this->videoHeight;
    }

    public function getVideoFrameRate()
    {
        return $this->videoFrameRate;
    }

    public function getVideoBandwidth()
    {
        return $this->videoBandwidth;
    }

    public function getVideoCodec()
    {
        return $this->videoCodec;
    }

    public function getAudioBandwidth()
    {
        return $this->audioBandwidth;
    }

    public function getAudioSampleRate()
    {
        return $this->audioSampleRate;
    }

    public function getAudioCodec()
    {
        return $this->audioCodec;
    }

    public function parseFromXml($strXml)
    {
        $xml = simplexml_load_string($strXml);
        $this->status = (string)($xml->Status);
        $this->connectedTime = (string)($xml->ConnectedTime);
        $this->remoteAddr = (string)($xml->RemoteAddr);

        if (isset($xml->Video)) {
            foreach ($xml->Video as $video) {
                $this->videoWidth = (int)($video->Width);
                $this->videoHeight = (int)($video->Height);
                $this->videoFrameRate = (int)($video->FrameRate);
                $this->videoBandwidth = (int)($video->Bandwidth);
                $this->videoCodec = (string)($video->Codec);
            }
        }

        if (isset($xml->Video)) {
            foreach ($xml->Audio as $audio) {
                $this->audioBandwidth = (int)($audio->Bandwidth);
                $this->audioSampleRate = (int)($audio->SampleRate);
                $this->audioCodec = (string)($audio->Codec);
            }
        }
    }

    public function serializeToXml()
    {
        throw new OssException('Not implemented.');
    }
}
