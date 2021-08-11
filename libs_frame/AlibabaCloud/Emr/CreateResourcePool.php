<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getNote()
 * @method $this withNote($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getActive()
 * @method $this withActive($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getYarnSiteConfig()
 * @method $this withYarnSiteConfig($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getConfig()
 * @method string getPoolType()
 * @method $this withPoolType($value)
 */
class CreateResourcePool extends Rpc
{
    /**
     * @return $this
     */
    public function withConfig(array $config)
    {
        $this->data['Config'] = $config;
        foreach ($config as $depth1 => $depth1Value) {
            if (isset($depth1Value['ConfigKey'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ConfigKey'] = $depth1Value['ConfigKey'];
            }
            if (isset($depth1Value['Note'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Note'] = $depth1Value['Note'];
            }
            if (isset($depth1Value['ConfigType'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.configType'] = $depth1Value['ConfigType'];
            }
            if (isset($depth1Value['TargetId'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.TargetId'] = $depth1Value['TargetId'];
            }
            if (isset($depth1Value['ConfigValue'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ConfigValue'] = $depth1Value['ConfigValue'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
        }

        return $this;
    }
}
