<?php
namespace AliOss\Result;

use AliOss\Model\LiveChannelInfo;

class PutLiveChannelResult extends Result {
    protected function parseDataFromResponse(){
        $content = $this->rawResponse->body;
        $channel = new LiveChannelInfo();
        $channel->parseFromXml($content);

        return $channel;
    }
}
