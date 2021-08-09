<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of UpdateJob
 *
 * @method string getqueueName()
 * @method string getprojectName()
 * @method string getcode()
 * @method string getdescription()
 * @method string getplanJson()
 * @method string getengineVersion()
 * @method string getclusterId()
 * @method string getpackages()
 * @method string getfolderId()
 * @method string getproperties()
 * @method string getjobName()
 */
class UpdateJobRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/jobs/[jobName]';
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'UpdateJob', 'foas');
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
     * @param string $code
     *
     * @return $this
     */
    public function setcode($code)
    {
        $this->requestParameters['code'] = $code;
        $this->queryParameters['code'] = $code;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setdescription($description)
    {
        $this->requestParameters['description'] = $description;
        $this->queryParameters['description'] = $description;

        return $this;
    }

    /**
     * @param string $planJson
     *
     * @return $this
     */
    public function setplanJson($planJson)
    {
        $this->requestParameters['planJson'] = $planJson;
        $this->queryParameters['planJson'] = $planJson;

        return $this;
    }

    /**
     * @param string $engineVersion
     *
     * @return $this
     */
    public function setengineVersion($engineVersion)
    {
        $this->requestParameters['engineVersion'] = $engineVersion;
        $this->queryParameters['engineVersion'] = $engineVersion;

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

    /**
     * @param string $packages
     *
     * @return $this
     */
    public function setpackages($packages)
    {
        $this->requestParameters['packages'] = $packages;
        $this->queryParameters['packages'] = $packages;

        return $this;
    }

    /**
     * @param string $folderId
     *
     * @return $this
     */
    public function setfolderId($folderId)
    {
        $this->requestParameters['folderId'] = $folderId;
        $this->queryParameters['folderId'] = $folderId;

        return $this;
    }

    /**
     * @param string $properties
     *
     * @return $this
     */
    public function setproperties($properties)
    {
        $this->requestParameters['properties'] = $properties;
        $this->queryParameters['properties'] = $properties;

        return $this;
    }

    /**
     * @param string $jobName
     *
     * @return $this
     */
    public function setjobName($jobName)
    {
        $this->requestParameters['jobName'] = $jobName;
        $this->pathParameters['jobName'] = $jobName;

        return $this;
    }
}
