<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getCodePath()
 * @method $this withCodePath($value)
 * @method array getConfigMapList()
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getConfigMap()
 * @method $this withConfigMap($value)
 * @method string getStatefulSet()
 * @method $this withStatefulSet($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getSecretList()
 * @method string getCronJob()
 * @method $this withCronJob($value)
 * @method string getDeployment()
 * @method $this withDeployment($value)
 */
class CreateDeployConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withConfigMapList(array $configMapList)
    {
        $this->data['ConfigMapList'] = $configMapList;
        foreach ($configMapList as $i => $iValue) {
            $this->options['query']['ConfigMapList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSecretList(array $secretList)
    {
        $this->data['SecretList'] = $secretList;
        foreach ($secretList as $i => $iValue) {
            $this->options['query']['SecretList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
