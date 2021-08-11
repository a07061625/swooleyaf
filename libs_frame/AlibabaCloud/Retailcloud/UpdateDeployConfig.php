<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getCodePath()
 * @method $this withCodePath($value)
 * @method array getConfigMapList()
 * @method string getConfigMap()
 * @method $this withConfigMap($value)
 * @method string getStatefulSet()
 * @method $this withStatefulSet($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method array getSecretList()
 * @method string getId()
 * @method $this withId($value)
 * @method string getCronJob()
 * @method $this withCronJob($value)
 * @method string getDeployment()
 * @method $this withDeployment($value)
 */
class UpdateDeployConfig extends Rpc
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
