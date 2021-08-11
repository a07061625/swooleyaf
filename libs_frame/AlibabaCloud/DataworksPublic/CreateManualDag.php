<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getProjectName()
 * @method string getBizDate()
 * @method string getFlowName()
 * @method string getDagParameters()
 * @method string getNodeParameters()
 */
class CreateManualDag extends Rpc
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
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->options['form_params']['ProjectName'] = $value;

        return $this;
    }

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
    public function withFlowName($value)
    {
        $this->data['FlowName'] = $value;
        $this->options['form_params']['FlowName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDagParameters($value)
    {
        $this->data['DagParameters'] = $value;
        $this->options['form_params']['DagParameters'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeParameters($value)
    {
        $this->data['NodeParameters'] = $value;
        $this->options['form_params']['NodeParameters'] = $value;

        return $this;
    }
}
