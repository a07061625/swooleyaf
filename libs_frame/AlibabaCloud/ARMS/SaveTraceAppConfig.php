<?php

namespace AlibabaCloud\ARMS;

/**
 * @method array getSettings()
 * @method string getPid()
 * @method $this withPid($value)
 */
class SaveTraceAppConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withSettings(array $settings)
    {
        $this->data['Settings'] = $settings;
        foreach ($settings as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Settings.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Settings.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
