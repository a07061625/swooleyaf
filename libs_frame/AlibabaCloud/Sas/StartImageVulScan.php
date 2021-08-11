<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getRepoId()
 * @method $this withRepoId($value)
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getImageDigest()
 * @method $this withImageDigest($value)
 * @method string getRepName()
 * @method $this withRepName($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getImageTag()
 * @method $this withImageTag($value)
 * @method array getRegistryTypes()
 * @method string getRepoInstanceId()
 * @method $this withRepoInstanceId($value)
 * @method string getImageLayer()
 * @method $this withImageLayer($value)
 * @method string getRepoRegionId()
 * @method $this withRepoRegionId($value)
 */
class StartImageVulScan extends Rpc
{
    /**
     * @return $this
     */
    public function withRegistryTypes(array $registryTypes)
    {
        $this->data['RegistryTypes'] = $registryTypes;
        foreach ($registryTypes as $i => $iValue) {
            $this->options['query']['RegistryTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
