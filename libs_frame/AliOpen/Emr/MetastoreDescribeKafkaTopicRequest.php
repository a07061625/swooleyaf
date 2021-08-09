<?php

namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of MetastoreDescribeKafkaTopic
 *
 * @method string getResourceOwnerId()
 * @method string getTopicId()
 */
class MetastoreDescribeKafkaTopicRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'MetastoreDescribeKafkaTopic', 'emr');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $topicId
     *
     * @return $this
     */
    public function setTopicId($topicId)
    {
        $this->requestParameters['TopicId'] = $topicId;
        $this->queryParameters['TopicId'] = $topicId;

        return $this;
    }
}
