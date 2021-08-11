<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method array getData()
 */
class UpdateUserBucketConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withData(array $data)
    {
        $this->data['Data'] = $data;
        foreach ($data as $depth1 => $depth1Value) {
            if (isset($depth1Value['Bucket'])) {
                $this->options['form_params']['Data.' . ($depth1 + 1) . '.Bucket'] = $depth1Value['Bucket'];
            }
            if (isset($depth1Value['Region'])) {
                $this->options['form_params']['Data.' . ($depth1 + 1) . '.Region'] = $depth1Value['Region'];
            }
        }

        return $this;
    }
}
