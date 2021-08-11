<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getHeadless()
 * @method $this withHeadless($value)
 * @method string getServiceType()
 * @method $this withServiceType($value)
 * @method string getK8sServiceId()
 * @method $this withK8sServiceId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method array getPortMappings()
 * @method string getEnvId()
 * @method $this withEnvId($value)
 */
class CreateService extends Rpc
{
    /**
     * @return $this
     */
    public function withPortMappings(array $portMappings)
    {
        $this->data['PortMappings'] = $portMappings;
        foreach ($portMappings as $depth1 => $depth1Value) {
            if (isset($depth1Value['Protocol'])) {
                $this->options['form_params']['PortMappings.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['Port'])) {
                $this->options['form_params']['PortMappings.' . ($depth1 + 1) . '.Port'] = $depth1Value['Port'];
            }
            if (isset($depth1Value['Name'])) {
                $this->options['form_params']['PortMappings.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
            if (isset($depth1Value['NodePort'])) {
                $this->options['form_params']['PortMappings.' . ($depth1 + 1) . '.NodePort'] = $depth1Value['NodePort'];
            }
            if (isset($depth1Value['TargetPort'])) {
                $this->options['form_params']['PortMappings.' . ($depth1 + 1) . '.TargetPort'] = $depth1Value['TargetPort'];
            }
        }

        return $this;
    }
}
