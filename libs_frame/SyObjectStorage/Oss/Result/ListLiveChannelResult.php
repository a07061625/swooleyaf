<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\LiveChannelListInfo;

class ListLiveChannelResult extends Result
{
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channelList = new LiveChannelListInfo();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
