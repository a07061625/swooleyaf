<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTemplateBody()
 * @method $this withTemplateBody($value)
 * @method array getParameters()
 * @method string getTemplateURL()
 * @method $this withTemplateURL($value)
 */
class GetTemplateEstimateCost extends Rpc
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
