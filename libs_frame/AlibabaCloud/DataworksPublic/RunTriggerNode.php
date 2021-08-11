<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBizDate()
 * @method string getAppId()
 * @method string getCycleTime()
 * @method string getNodeId()
 */
class RunTriggerNode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizDate($value)
    {
        $this->data['BizDate'] = $value;
        $this->options['form_params']['BizDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['form_params']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCycleTime($value)
    {
        $this->data['CycleTime'] = $value;
        $this->options['form_params']['CycleTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeId($value)
    {
        $this->data['NodeId'] = $value;
        $this->options['form_params']['NodeId'] = $value;

        return $this;
    }
}
