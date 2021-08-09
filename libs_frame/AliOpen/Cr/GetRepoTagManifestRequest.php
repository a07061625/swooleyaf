<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetRepoTagManifest
 *
 * @method string getRepoId()
 * @method string getSchemaVersion()
 * @method string getInstanceId()
 * @method string getTag()
 */
class GetRepoTagManifestRequest extends RpcAcsRequest
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
            'GetRepoTagManifest',
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
     * @param string $schemaVersion
     *
     * @return $this
     */
    public function setSchemaVersion($schemaVersion)
    {
        $this->requestParameters['SchemaVersion'] = $schemaVersion;
        $this->queryParameters['SchemaVersion'] = $schemaVersion;

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
     * @param string $tag
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->requestParameters['Tag'] = $tag;
        $this->queryParameters['Tag'] = $tag;

        return $this;
    }
}
