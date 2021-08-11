<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getActive()
 * @method $this withActive($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getYarnsiteconfig()
 * @method $this withYarnsiteconfig($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getId()
 * @method $this withId($value)
 * @method array getConfig()
 */
class ModifyResourcePool extends Rpc
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
            if (isset($depth1Value['ConfigValue'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.ConfigValue'] = $depth1Value['ConfigValue'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['Config.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
        }

        return $this;
    }
}
