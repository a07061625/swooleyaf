<?php
namespace AliOss\Result;

use AliOss\Model\GetLiveChannelInfo;

class GetLiveChannelInfoResult extends Result {
    /**
     * @return \AliOss\Model\GetLiveChannelInfo
     */
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        $channelList = new GetLiveChannelInfo();
        $channelList->parseFromXml($content);

        return $channelList;
    }
}
