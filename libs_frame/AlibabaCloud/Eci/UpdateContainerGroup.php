<?php

namespace AlibabaCloud\Eci;

/**
 * @method array getContainer()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMemory()
 * @method $this withMemory($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getInitContainer()
 * @method array getImageRegistryCredential()
 * @method array getTag()
 * @method string getContainerGroupId()
 * @method $this withContainerGroupId($value)
 * @method array getDnsConfigNameServer()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getRestartPolicy()
 * @method $this withRestartPolicy($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getDnsConfigOption()
 * @method string getCpu()
 * @method $this withCpu($value)
 * @method array getDnsConfigSearch()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getVolume()
 */
class UpdateContainerGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withContainer(array $container)
    {
        $this->data['Container'] = $container;
        foreach ($container as $depth1 => $depth1Value) {
            $this->options['query']['Container.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.Image'] = $depth1Value['Image'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.Cpu'] = $depth1Value['Cpu'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.Memory'] = $depth1Value['Memory'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.WorkingDir'] = $depth1Value['WorkingDir'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ImagePullPolicy'] = $depth1Value['ImagePullPolicy'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.Stdin'] = $depth1Value['Stdin'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.StdinOnce'] = $depth1Value['StdinOnce'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.Tty'] = $depth1Value['Tty'];
            foreach ($depth1Value['Command'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.Command.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['Arg'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.Arg.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['EnvironmentVar'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.EnvironmentVar.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['Port'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.Port.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['VolumeMount'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.VolumeMount.' . ($i + 1)] = $iValue;
            }
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.TcpSocket.Port'] = $depth1Value['ReadinessProbeTcpSocketPort'];
            foreach ($depth1Value['ReadinessProbeExecCommand'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.Exec.Command.' . ($i + 1)] = $iValue;
            }
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.HttpGet.Path'] = $depth1Value['ReadinessProbeHttpGetPath'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.HttpGet.Port'] = $depth1Value['ReadinessProbeHttpGetPort'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.HttpGet.Scheme'] = $depth1Value['ReadinessProbeHttpGetScheme'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.InitialDelaySeconds'] = $depth1Value['ReadinessProbeInitialDelaySeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.PeriodSeconds'] = $depth1Value['ReadinessProbePeriodSeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.SuccessThreshold'] = $depth1Value['ReadinessProbeSuccessThreshold'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.FailureThreshold'] = $depth1Value['ReadinessProbeFailureThreshold'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.ReadinessProbe.TimeoutSeconds'] = $depth1Value['ReadinessProbeTimeoutSeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.TcpSocket.Port'] = $depth1Value['LivenessProbeTcpSocketPort'];
            foreach ($depth1Value['LivenessProbeExecCommand'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.Exec.Command.' . ($i + 1)] = $iValue;
            }
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.HttpGet.Path'] = $depth1Value['LivenessProbeHttpGetPath'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.HttpGet.Port'] = $depth1Value['LivenessProbeHttpGetPort'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.HttpGet.Scheme'] = $depth1Value['LivenessProbeHttpGetScheme'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.InitialDelaySeconds'] = $depth1Value['LivenessProbeInitialDelaySeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.PeriodSeconds'] = $depth1Value['LivenessProbePeriodSeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.SuccessThreshold'] = $depth1Value['LivenessProbeSuccessThreshold'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.FailureThreshold'] = $depth1Value['LivenessProbeFailureThreshold'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.LivenessProbe.TimeoutSeconds'] = $depth1Value['LivenessProbeTimeoutSeconds'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.SecurityContext.ReadOnlyRootFilesystem'] = $depth1Value['SecurityContextReadOnlyRootFilesystem'];
            $this->options['query']['Container.' . ($depth1 + 1) . '.SecurityContext.RunAsUser'] = $depth1Value['SecurityContextRunAsUser'];
            foreach ($depth1Value['SecurityContextCapabilityAdd'] as $i => $iValue) {
                $this->options['query']['Container.' . ($depth1 + 1) . '.SecurityContext.Capability.Add.' . ($i + 1)] = $iValue;
            }
            $this->options['query']['Container.' . ($depth1 + 1) . '.Gpu'] = $depth1Value['Gpu'];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInitContainer(array $initContainer)
    {
        $this->data['InitContainer'] = $initContainer;
        foreach ($initContainer as $depth1 => $depth1Value) {
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Image'] = $depth1Value['Image'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Cpu'] = $depth1Value['Cpu'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Memory'] = $depth1Value['Memory'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.WorkingDir'] = $depth1Value['WorkingDir'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.ImagePullPolicy'] = $depth1Value['ImagePullPolicy'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Stdin'] = $depth1Value['Stdin'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.StdinOnce'] = $depth1Value['StdinOnce'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Tty'] = $depth1Value['Tty'];
            foreach ($depth1Value['Command'] as $i => $iValue) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Command.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['Arg'] as $i => $iValue) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Arg.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['EnvironmentVar'] as $depth2 => $depth2Value) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.EnvironmentVar.' . ($depth2 + 1) . '.Key'] = $depth2Value['Key'];
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.EnvironmentVar.' . ($depth2 + 1) . '.Value'] = $depth2Value['Value'];
            }
            foreach ($depth1Value['Port'] as $depth2 => $depth2Value) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Port.' . ($depth2 + 1) . '.Port'] = $depth2Value['Port'];
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Port.' . ($depth2 + 1) . '.Protocol'] = $depth2Value['Protocol'];
            }
            foreach ($depth1Value['VolumeMount'] as $depth2 => $depth2Value) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.VolumeMount.' . ($depth2 + 1) . '.Name'] = $depth2Value['Name'];
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.VolumeMount.' . ($depth2 + 1) . '.MountPath'] = $depth2Value['MountPath'];
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.VolumeMount.' . ($depth2 + 1) . '.SubPath'] = $depth2Value['SubPath'];
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.VolumeMount.' . ($depth2 + 1) . '.ReadOnly'] = $depth2Value['ReadOnly'];
            }
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.SecurityContext.ReadOnlyRootFilesystem'] = $depth1Value['SecurityContextReadOnlyRootFilesystem'];
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.SecurityContext.RunAsUser'] = $depth1Value['SecurityContextRunAsUser'];
            foreach ($depth1Value['SecurityContextCapabilityAdd'] as $i => $iValue) {
                $this->options['query']['InitContainer.' . ($depth1 + 1) . '.SecurityContext.Capability.Add.' . ($i + 1)] = $iValue;
            }
            $this->options['query']['InitContainer.' . ($depth1 + 1) . '.Gpu'] = $depth1Value['Gpu'];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withImageRegistryCredential(array $imageRegistryCredential)
    {
        $this->data['ImageRegistryCredential'] = $imageRegistryCredential;
        foreach ($imageRegistryCredential as $depth1 => $depth1Value) {
            $this->options['query']['ImageRegistryCredential.' . ($depth1 + 1) . '.Server'] = $depth1Value['Server'];
            $this->options['query']['ImageRegistryCredential.' . ($depth1 + 1) . '.UserName'] = $depth1Value['UserName'];
            $this->options['query']['ImageRegistryCredential.' . ($depth1 + 1) . '.Password'] = $depth1Value['Password'];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDnsConfigNameServer(array $dnsConfigNameServer)
    {
        $this->data['DnsConfigNameServer'] = $dnsConfigNameServer;
        foreach ($dnsConfigNameServer as $i => $iValue) {
            $this->options['query']['DnsConfig.NameServer.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDnsConfigOption(array $dnsConfigOption)
    {
        $this->data['DnsConfigOption'] = $dnsConfigOption;
        foreach ($dnsConfigOption as $depth1 => $depth1Value) {
            $this->options['query']['DnsConfig.Option.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['query']['DnsConfig.Option.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDnsConfigSearch(array $dnsConfigSearch)
    {
        $this->data['DnsConfigSearch'] = $dnsConfigSearch;
        foreach ($dnsConfigSearch as $i => $iValue) {
            $this->options['query']['DnsConfig.Search.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withVolume(array $volume)
    {
        $this->data['Volume'] = $volume;
        foreach ($volume as $depth1 => $depth1Value) {
            $this->options['query']['Volume.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['query']['Volume.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            $this->options['query']['Volume.' . ($depth1 + 1) . '.NFSVolume.Server'] = $depth1Value['NFSVolumeServer'];
            $this->options['query']['Volume.' . ($depth1 + 1) . '.NFSVolume.Path'] = $depth1Value['NFSVolumePath'];
            $this->options['query']['Volume.' . ($depth1 + 1) . '.NFSVolume.ReadOnly'] = $depth1Value['NFSVolumeReadOnly'];
            foreach ($depth1Value['ConfigFileVolumeConfigFileToPath'] as $depth2 => $depth2Value) {
                $this->options['query']['Volume.' . ($depth1 + 1) . '.ConfigFileVolume.ConfigFileToPath.' . ($depth2 + 1) . '.Content'] = $depth2Value['Content'];
                $this->options['query']['Volume.' . ($depth1 + 1) . '.ConfigFileVolume.ConfigFileToPath.' . ($depth2 + 1) . '.Path'] = $depth2Value['Path'];
            }
            $this->options['query']['Volume.' . ($depth1 + 1) . '.EmptyDirVolume.Medium'] = $depth1Value['EmptyDirVolumeMedium'];
        }

        return $this;
    }
}
