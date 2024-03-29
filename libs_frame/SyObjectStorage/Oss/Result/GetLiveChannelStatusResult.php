<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\GetLiveChannelStatus;

class GetLiveChannelStatusResult extends Result
{
    /**
     * @return \SyObjectStorage\Oss\Model\GetLiveChannelStatus
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelStatus();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
