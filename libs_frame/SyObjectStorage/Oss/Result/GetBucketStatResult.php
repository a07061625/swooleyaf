<?php

namespace SyObjectStorage\Oss\Result;

use SyObjectStorage\Oss\Model\BucketStat;

/**
 * Class GetRefererResult
 *
 * @package SyObjectStorage\Oss\Result
 */
class GetBucketStatResult extends Result
{
    /**
     * Parse bucket stat data
     *
     * @return BucketStat
     */
    protected function parseDataFromResponse()
    {
        $content = $this->rawResponse->body;
        $stat = new BucketStat();
        $stat->parseFromXml($content);

        return $stat;
    }
}
