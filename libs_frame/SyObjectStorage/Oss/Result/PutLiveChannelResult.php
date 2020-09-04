<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\LiveChannelInfo;

class PutLiveChannelResult extends Result
{
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channel = new LiveChannelInfo();
        $channel->parseFromXml($content);

        return $channel;
    }
}
