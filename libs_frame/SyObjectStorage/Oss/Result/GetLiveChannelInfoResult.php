<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\GetLiveChannelInfo;

class GetLiveChannelInfoResult extends Result
{
    /**
     * @return \SyObjectStorage\Oss\Model\GetLiveChannelInfo
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelInfo();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
