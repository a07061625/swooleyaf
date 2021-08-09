<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateChartRepository
 *
 * @method string getRepoType()
 * @method string getSummary()
 * @method string getInstanceId()
 * @method string getRepoNamespaceName()
 * @method string getRepoName()
 */
class UpdateChartRepositoryRequest extends RpcAcsRequest
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
        parent::__construct(
            'cr',
            '2018-12-01',
            'UpdateChartRepository',
            'acr'
        );
    }

    /**
     * @param string $repoType
     *
     * @return $this
     */
    public function setRepoType($repoType)
    {
        $this->requestParameters['RepoType'] = $repoType;
        $this->queryParameters['RepoType'] = $repoType;

        return $this;
    }

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->requestParameters['Summary'] = $summary;
        $this->queryParameters['Summary'] = $summary;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $repoNamespaceName
     *
     * @return $this
     */
    public function setRepoNamespaceName($repoNamespaceName)
    {
        $this->requestParameters['RepoNamespaceName'] = $repoNamespaceName;
        $this->queryParameters['RepoNamespaceName'] = $repoNamespaceName;

        return $this;
    }

    /**
     * @param string $repoName
     *
     * @return $this
     */
    public function setRepoName($repoName)
    {
        $this->requestParameters['RepoName'] = $repoName;
        $this->queryParameters['RepoName'] = $repoName;

        return $this;
    }
}
