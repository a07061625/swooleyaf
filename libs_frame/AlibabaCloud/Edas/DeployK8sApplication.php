<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getNasId()
 * @method string getWebContainer()
 * @method string getReadiness()
 * @method string getBatchWaitTime()
 * @method string getLiveness()
 * @method string getEnvs()
 * @method string getCpuLimit()
 * @method string getPackageVersion()
 * @method string getStorageType()
 * @method string getEdasContainerVersion()
 * @method string getPackageUrl()
 * @method string getMemoryLimit()
 * @method string getImageTag()
 * @method string getMemoryRequest()
 * @method string getImage()
 * @method string getPreStop()
 * @method string getMountDescs()
 * @method string getReplicas()
 * @method string getCpuRequest()
 * @method string getLocalVolume()
 * @method string getCommand()
 * @method string getArgs()
 * @method string getJDK()
 * @method string getAppId()
 * @method string getPostStart()
 */
class DeployK8sApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/k8s_apps';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNasId($value)
    {
        $this->data['NasId'] = $value;
        $this->options['query']['NasId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWebContainer($value)
    {
        $this->data['WebContainer'] = $value;
        $this->options['query']['WebContainer'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReadiness($value)
    {
        $this->data['Readiness'] = $value;
        $this->options['query']['Readiness'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatchWaitTime($value)
    {
        $this->data['BatchWaitTime'] = $value;
        $this->options['query']['BatchWaitTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLiveness($value)
    {
        $this->data['Liveness'] = $value;
        $this->options['query']['Liveness'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnvs($value)
    {
        $this->data['Envs'] = $value;
        $this->options['query']['Envs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpuLimit($value)
    {
        $this->data['CpuLimit'] = $value;
        $this->options['query']['CpuLimit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageVersion($value)
    {
        $this->data['PackageVersion'] = $value;
        $this->options['query']['PackageVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStorageType($value)
    {
        $this->data['StorageType'] = $value;
        $this->options['query']['StorageType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEdasContainerVersion($value)
    {
        $this->data['EdasContainerVersion'] = $value;
        $this->options['query']['EdasContainerVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageUrl($value)
    {
        $this->data['PackageUrl'] = $value;
        $this->options['query']['PackageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemoryLimit($value)
    {
        $this->data['MemoryLimit'] = $value;
        $this->options['query']['MemoryLimit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageTag($value)
    {
        $this->data['ImageTag'] = $value;
        $this->options['query']['ImageTag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemoryRequest($value)
    {
        $this->data['MemoryRequest'] = $value;
        $this->options['query']['MemoryRequest'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImage($value)
    {
        $this->data['Image'] = $value;
        $this->options['query']['Image'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPreStop($value)
    {
        $this->data['PreStop'] = $value;
        $this->options['query']['PreStop'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMountDescs($value)
    {
        $this->data['MountDescs'] = $value;
        $this->options['query']['MountDescs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReplicas($value)
    {
        $this->data['Replicas'] = $value;
        $this->options['query']['Replicas'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpuRequest($value)
    {
        $this->data['CpuRequest'] = $value;
        $this->options['query']['CpuRequest'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocalVolume($value)
    {
        $this->data['LocalVolume'] = $value;
        $this->options['query']['LocalVolume'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommand($value)
    {
        $this->data['Command'] = $value;
        $this->options['query']['Command'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withArgs($value)
    {
        $this->data['Args'] = $value;
        $this->options['query']['Args'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJDK($value)
    {
        $this->data['JDK'] = $value;
        $this->options['query']['JDK'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPostStart($value)
    {
        $this->data['PostStart'] = $value;
        $this->options['query']['PostStart'] = $value;

        return $this;
    }
}
