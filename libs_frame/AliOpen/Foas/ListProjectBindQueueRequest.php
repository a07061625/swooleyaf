<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ListProjectBindQueue
 *
 * @method string getqueueName()
 * @method string getprojectName()
 * @method string getclusterId()
 */
class ListProjectBindQueueRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/queues';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'ListProjectBindQueue', 'foas');
    }

    /**
     * @param string $queueName
     *
     * @return $this
     */
    public function setqueueName($queueName)
    {
        $this->requestParameters['queueName'] = $queueName;
        $this->queryParameters['queueName'] = $queueName;

        return $this;
    }

    /**
     * @param string $projectName
     *
     * @return $this
     */
    public function setprojectName($projectName)
    {
        $this->requestParameters['projectName'] = $projectName;
        $this->pathParameters['projectName'] = $projectName;

        return $this;
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setclusterId($clusterId)
    {
        $this->requestParameters['clusterId'] = $clusterId;
        $this->queryParameters['clusterId'] = $clusterId;

        return $this;
    }
}
