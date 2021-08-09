<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeTopicList
 *
 * @method string getSourceIp()
 */
class TopicListDescribeRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('aegis', '2016-11-11', 'DescribeTopicList', 'vipaegis');
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }
}
