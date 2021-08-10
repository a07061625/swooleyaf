<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getStackPolicyURL()
 * @method $this withStackPolicyURL($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTemplateBody()
 * @method $this withTemplateBody($value)
 * @method string getDisableRollback()
 * @method $this withDisableRollback($value)
 * @method string getStackName()
 * @method $this withStackName($value)
 * @method array getParameters()
 * @method string getStackPolicyBody()
 * @method $this withStackPolicyBody($value)
 * @method string getTimeoutInMinutes()
 * @method $this withTimeoutInMinutes($value)
 * @method string getTemplateURL()
 * @method $this withTemplateURL($value)
 */
class PreviewStack extends Rpc
{
    /**
     * @return $this
     */
    public function withParameters(array $parameters)
    {
        $this->data['Parameters'] = $parameters;
        foreach ($parameters as $depth1 => $depth1Value) {
            $this->options['query']['Parameters.' . ($depth1 + 1) . '.ParameterValue'] = $depth1Value['ParameterValue'];
            $this->options['query']['Parameters.' . ($depth1 + 1) . '.ParameterKey'] = $depth1Value['ParameterKey'];
        }

        return $this;
    }
}
