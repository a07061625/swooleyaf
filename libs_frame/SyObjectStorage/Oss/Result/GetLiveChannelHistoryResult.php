<?php
namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\GetLiveChannelHistory;

class GetLiveChannelHistoryResult extends Result
{
    /**
     * @return array
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelHistory();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
