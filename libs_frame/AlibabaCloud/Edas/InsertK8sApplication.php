<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getNasId()
 * @method string getRepoId()
 * @method string getInternetTargetPort()
 * @method string getWebContainer()
 * @method string getIntranetSlbId()
 * @method string getCommandArgs()
 * @method string getReadiness()
 * @method string getLiveness()
 * @method string getInternetSlbPort()
 * @method string getEnvs()
 * @method string getRequestsMem()
 * @method string getPackageVersion()
 * @method string getStorageType()
 * @method string getLimitMem()
 * @method string getEdasContainerVersion()
 * @method string getAppName()
 * @method string getInternetSlbId()
 * @method string getLogicalRegionId()
 * @method string getPackageUrl()
 * @method string getInternetSlbProtocol()
 * @method string getIntranetSlbPort()
 * @method string getPreStop()
 * @method string getMountDescs()
 * @method string getReplicas()
 * @method string getLimitCpu()
 * @method string getClusterId()
 * @method string getIntranetTargetPort()
 * @method string getLocalVolume()
 * @method string getCommand()
 * @method string getJDK()
 * @method string getIntranetSlbProtocol()
 * @method string getImageUrl()
 * @method string getNamespace()
 * @method string getApplicationDescription()
 * @method string getPackageType()
 * @method string getRequestsCpu()
 * @method string getPostStart()
 */
class InsertK8sApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/create_k8s_app';

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
    public function withRepoId($value)
    {
        $this->data['RepoId'] = $value;
        $this->options['query']['RepoId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternetTargetPort($value)
    {
        $this->data['InternetTargetPort'] = $value;
        $this->options['query']['InternetTargetPort'] = $value;

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
    public function withIntranetSlbId($value)
    {
        $this->data['IntranetSlbId'] = $value;
        $this->options['query']['IntranetSlbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommandArgs($value)
    {
        $this->data['CommandArgs'] = $value;
        $this->options['query']['CommandArgs'] = $value;

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
    public function withInternetSlbPort($value)
    {
        $this->data['InternetSlbPort'] = $value;
        $this->options['query']['InternetSlbPort'] = $value;

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
    public function withRequestsMem($value)
    {
        $this->data['RequestsMem'] = $value;
        $this->options['query']['RequestsMem'] = $value;

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
    public function withLimitMem($value)
    {
        $this->data['LimitMem'] = $value;
        $this->options['query']['LimitMem'] = $value;

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
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['query']['AppName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternetSlbId($value)
    {
        $this->data['InternetSlbId'] = $value;
        $this->options['query']['InternetSlbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogicalRegionId($value)
    {
        $this->data['LogicalRegionId'] = $value;
        $this->options['query']['LogicalRegionId'] = $value;

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
    public function withInternetSlbProtocol($value)
    {
        $this->data['InternetSlbProtocol'] = $value;
        $this->options['query']['InternetSlbProtocol'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranetSlbPort($value)
    {
        $this->data['IntranetSlbPort'] = $value;
        $this->options['query']['IntranetSlbPort'] = $value;

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
    public function withLimitCpu($value)
    {
        $this->data['LimitCpu'] = $value;
        $this->options['query']['LimitCpu'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranetTargetPort($value)
    {
        $this->data['IntranetTargetPort'] = $value;
        $this->options['query']['IntranetTargetPort'] = $value;

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
    public function withIntranetSlbProtocol($value)
    {
        $this->data['IntranetSlbProtocol'] = $value;
        $this->options['query']['IntranetSlbProtocol'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['query']['ImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespace($value)
    {
        $this->data['Namespace'] = $value;
        $this->options['query']['Namespace'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApplicationDescription($value)
    {
        $this->data['ApplicationDescription'] = $value;
        $this->options['query']['ApplicationDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageType($value)
    {
        $this->data['PackageType'] = $value;
        $this->options['query']['PackageType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRequestsCpu($value)
    {
        $this->data['RequestsCpu'] = $value;
        $this->options['query']['RequestsCpu'] = $value;

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
