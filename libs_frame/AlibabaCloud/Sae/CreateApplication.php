<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNasId()
 * @method string getWebContainer()
 * @method string getJarStartArgs()
 * @method string getMemory()
 * @method string getSlsConfigs()
 * @method string getCommandArgs()
 * @method string getAcrAssumeRoleArn()
 * @method string getReadiness()
 * @method string getTimezone()
 * @method string getMountHost()
 * @method string getAutoConfig()
 * @method string getLiveness()
 * @method string getSecurityGroupId()
 * @method string getEnvs()
 * @method string getPhpArmsConfigLocation()
 * @method string getPackageVersion()
 * @method string getTomcatConfig()
 * @method string getCustomHostAlias()
 * @method string getDeploy()
 * @method string getWarStartOptions()
 * @method string getJarStartOptions()
 * @method string getEdasContainerVersion()
 * @method string getAppName()
 * @method string getNamespaceId()
 * @method string getPackageUrl()
 * @method string getTerminationGracePeriodSeconds()
 * @method string getConfigMapMountDesc()
 * @method string getPhpConfig()
 * @method string getPreStop()
 * @method string getReplicas()
 * @method string getCpu()
 * @method string getCommand()
 * @method string getMountDesc()
 * @method string getVSwitchId()
 * @method string getJdk()
 * @method string getAppDescription()
 * @method string getVpcId()
 * @method string getImageUrl()
 * @method string getPackageType()
 * @method string getPhpConfigLocation()
 * @method string getPostStart()
 */
class CreateApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/createApplication';

    /** @var string */
    public $method = 'POST';

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
    public function withJarStartArgs($value)
    {
        $this->data['JarStartArgs'] = $value;
        $this->options['query']['JarStartArgs'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemory($value)
    {
        $this->data['Memory'] = $value;
        $this->options['query']['Memory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSlsConfigs($value)
    {
        $this->data['SlsConfigs'] = $value;
        $this->options['query']['SlsConfigs'] = $value;

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
    public function withAcrAssumeRoleArn($value)
    {
        $this->data['AcrAssumeRoleArn'] = $value;
        $this->options['query']['AcrAssumeRoleArn'] = $value;

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
    public function withTimezone($value)
    {
        $this->data['Timezone'] = $value;
        $this->options['query']['Timezone'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMountHost($value)
    {
        $this->data['MountHost'] = $value;
        $this->options['query']['MountHost'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoConfig($value)
    {
        $this->data['AutoConfig'] = $value;
        $this->options['query']['AutoConfig'] = $value;

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
    public function withSecurityGroupId($value)
    {
        $this->data['SecurityGroupId'] = $value;
        $this->options['query']['SecurityGroupId'] = $value;

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
    public function withPhpArmsConfigLocation($value)
    {
        $this->data['PhpArmsConfigLocation'] = $value;
        $this->options['query']['PhpArmsConfigLocation'] = $value;

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
    public function withTomcatConfig($value)
    {
        $this->data['TomcatConfig'] = $value;
        $this->options['query']['TomcatConfig'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCustomHostAlias($value)
    {
        $this->data['CustomHostAlias'] = $value;
        $this->options['query']['CustomHostAlias'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeploy($value)
    {
        $this->data['Deploy'] = $value;
        $this->options['query']['Deploy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWarStartOptions($value)
    {
        $this->data['WarStartOptions'] = $value;
        $this->options['query']['WarStartOptions'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJarStartOptions($value)
    {
        $this->data['JarStartOptions'] = $value;
        $this->options['query']['JarStartOptions'] = $value;

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
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

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
    public function withTerminationGracePeriodSeconds($value)
    {
        $this->data['TerminationGracePeriodSeconds'] = $value;
        $this->options['query']['TerminationGracePeriodSeconds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfigMapMountDesc($value)
    {
        $this->data['ConfigMapMountDesc'] = $value;
        $this->options['form_params']['ConfigMapMountDesc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhpConfig($value)
    {
        $this->data['PhpConfig'] = $value;
        $this->options['form_params']['PhpConfig'] = $value;

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
    public function withCpu($value)
    {
        $this->data['Cpu'] = $value;
        $this->options['query']['Cpu'] = $value;

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
    public function withMountDesc($value)
    {
        $this->data['MountDesc'] = $value;
        $this->options['query']['MountDesc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVSwitchId($value)
    {
        $this->data['VSwitchId'] = $value;
        $this->options['query']['VSwitchId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJdk($value)
    {
        $this->data['Jdk'] = $value;
        $this->options['query']['Jdk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppDescription($value)
    {
        $this->data['AppDescription'] = $value;
        $this->options['query']['AppDescription'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVpcId($value)
    {
        $this->data['VpcId'] = $value;
        $this->options['query']['VpcId'] = $value;

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
    public function withPhpConfigLocation($value)
    {
        $this->data['PhpConfigLocation'] = $value;
        $this->options['query']['PhpConfigLocation'] = $value;

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
