<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getMcAddress()
 * @method array getDevEuiList()
 */
class BindNodesToMulticastGroup extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMcAddress($value)
    {
        $this->data['McAddress'] = $value;
        $this->options['form_params']['McAddress'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withDevEuiList(array $devEuiList)
    {
        $this->data['DevEuiList'] = $devEuiList;
        foreach ($devEuiList as $i => $iValue) {
            $this->options['form_params']['DevEuiList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
