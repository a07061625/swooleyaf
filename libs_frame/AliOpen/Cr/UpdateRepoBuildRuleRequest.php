<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateRepoBuildRule
 *
 * @method string getRepoId()
 * @method string getPushName()
 * @method string getDockerfileName()
 * @method string getDockerfileLocation()
 * @method string getBuildRuleId()
 * @method string getInstanceId()
 * @method string getImageTag()
 * @method string getPushType()
 */
class UpdateRepoBuildRuleRequest extends RpcAcsRequest
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
            'UpdateRepoBuildRule',
            'acr'
        );
    }

    /**
     * @param string $repoId
     *
     * @return $this
     */
    public function setRepoId($repoId)
    {
        $this->requestParameters['RepoId'] = $repoId;
        $this->queryParameters['RepoId'] = $repoId;

        return $this;
    }

    /**
     * @param string $pushName
     *
     * @return $this
     */
    public function setPushName($pushName)
    {
        $this->requestParameters['PushName'] = $pushName;
        $this->queryParameters['PushName'] = $pushName;

        return $this;
    }

    /**
     * @param string $dockerfileName
     *
     * @return $this
     */
    public function setDockerfileName($dockerfileName)
    {
        $this->requestParameters['DockerfileName'] = $dockerfileName;
        $this->queryParameters['DockerfileName'] = $dockerfileName;

        return $this;
    }

    /**
     * @param string $dockerfileLocation
     *
     * @return $this
     */
    public function setDockerfileLocation($dockerfileLocation)
    {
        $this->requestParameters['DockerfileLocation'] = $dockerfileLocation;
        $this->queryParameters['DockerfileLocation'] = $dockerfileLocation;

        return $this;
    }

    /**
     * @param string $buildRuleId
     *
     * @return $this
     */
    public function setBuildRuleId($buildRuleId)
    {
        $this->requestParameters['BuildRuleId'] = $buildRuleId;
        $this->queryParameters['BuildRuleId'] = $buildRuleId;

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
     * @param string $imageTag
     *
     * @return $this
     */
    public function setImageTag($imageTag)
    {
        $this->requestParameters['ImageTag'] = $imageTag;
        $this->queryParameters['ImageTag'] = $imageTag;

        return $this;
    }

    /**
     * @param string $pushType
     *
     * @return $this
     */
    public function setPushType($pushType)
    {
        $this->requestParameters['PushType'] = $pushType;
        $this->queryParameters['PushType'] = $pushType;

        return $this;
    }
}
