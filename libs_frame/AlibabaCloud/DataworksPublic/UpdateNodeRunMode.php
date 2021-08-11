<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getSchedulerType()
 * @method string getNodeId()
 */
class UpdateNodeRunMode extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectEnv($value)
    {
        $this->data['ProjectEnv'] = $value;
        $this->options['form_params']['ProjectEnv'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchedulerType($value)
    {
        $this->data['SchedulerType'] = $value;
        $this->options['form_params']['SchedulerType'] = $value;

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
