<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getBootstrapAction()
 * @method string getId()
 * @method $this withId($value)
 */
class ModifyClusterBootstrapAction extends Rpc
{
    /**
     * @return $this
     */
    public function withBootstrapAction(array $bootstrapAction)
    {
        $this->data['BootstrapAction'] = $bootstrapAction;
        foreach ($bootstrapAction as $depth1 => $depth1Value) {
            if (isset($depth1Value['Path'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Path'] = $depth1Value['Path'];
            }
            if (isset($depth1Value['ExecutionTarget'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionTarget'] = $depth1Value['ExecutionTarget'];
            }
            if (isset($depth1Value['ExecutionMoment'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionMoment'] = $depth1Value['ExecutionMoment'];
            }
            if (isset($depth1Value['Arg'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Arg'] = $depth1Value['Arg'];
            }
            if (isset($depth1Value['Name'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['ExecutionFailStrategy'])) {
                $this->options['query']['BootstrapAction.' . ($depth1 + 1) . '.ExecutionFailStrategy'] = $depth1Value['ExecutionFailStrategy'];
            }
        }

        return $this;
    }
}
