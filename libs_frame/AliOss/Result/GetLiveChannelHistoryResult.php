<?php
namespace AliOss\Result;

use AliOss\Model\GetLiveChannelHistory;

class GetLiveChannelHistoryResult extends Result {
    /**
     * @return \AliOss\Model\GetLiveChannelHistory
     */
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelHistory();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
