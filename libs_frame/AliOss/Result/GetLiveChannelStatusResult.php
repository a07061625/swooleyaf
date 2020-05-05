<?php
namespace AliOss\Result;

use AliOss\Model\GetLiveChannelStatus;

class GetLiveChannelStatusResult extends Result
{
    /**
     * @return array
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelStatus();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
