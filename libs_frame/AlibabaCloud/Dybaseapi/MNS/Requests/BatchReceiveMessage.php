<?php

namespace AlibabaCloud\Dybaseapi\MNS\Requests;

/**
 * Class BatchReceiveMessage
 *
 * @package AlibabaCloud\Dybaseapi\MNS\Requests
 */
class BatchReceiveMessage extends BaseRequest
{
    /**
     * @var null
     */
    private $queueName;

    /**
     * @var mixed
     */
    private $numOfMessages;

    /**
     * @var null
     */
    private $waitSeconds;

    /**
     * BatchReceiveMessageRequest constructor.
     *
     * @param      $numOfMessages
     * @param null $waitSeconds
     */
    public function __construct($numOfMessages, $waitSeconds = null)
    {
        parent::__construct('get', null);
        $this->numOfMessages = $numOfMessages;
        $this->waitSeconds = $waitSeconds;
    }

    /**
     * @param $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
        $this->resourcePath = 'queues/' . $queueName . '/messages';
    }

    /**
     * @return null|string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @return null|string
     */
    public function getWaitSeconds()
    {
        return $this->waitSeconds;
    }

    /**
     * @return mixed
     */
    public function getNumOfMessages()
    {
        return $this->numOfMessages;
    }

    public function generateBody()
    {
    }

    /**
     * @return string
     */
    public function generateQueryString()
    {
        $params = ['numOfMessages' => $this->numOfMessages];
        if (null !== $this->waitSeconds) {
            $params['waitseconds'] = $this->waitSeconds;
        }

        return http_build_query($params);
    }
}
