<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getConfigs()
 * @method string getDriverId()
 * @method $this withDriverId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class SetEdgeInstanceDriverConfigs extends Rpc
{
    /**
     * @return $this
     */
    public function withConfigs(array $configs)
    {
        $this->data['Configs'] = $configs;
        foreach ($configs as $depth1 => $depth1Value) {
            if (isset($depth1Value['Format'])) {
                $this->options['query']['Configs.' . ($depth1 + 1) . '.Format'] = $depth1Value['Format'];
            }
            if (isset($depth1Value['Content'])) {
                $this->options['query']['Configs.' . ($depth1 + 1) . '.Content'] = $depth1Value['Content'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Configs.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
