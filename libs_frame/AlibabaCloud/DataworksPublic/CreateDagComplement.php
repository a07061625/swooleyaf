<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getStartBizDate()
 * @method string getParallelism()
 * @method string getRootNodeId()
 * @method string getBizBeginTime()
 * @method string getEndBizDate()
 * @method string getIncludeNodeIds()
 * @method string getBizEndTime()
 * @method string getName()
 * @method string getExcludeNodeIds()
 * @method string getNodeParams()
 */
class CreateDagComplement extends Rpc
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
    public function withStartBizDate($value)
    {
        $this->data['StartBizDate'] = $value;
        $this->options['form_params']['StartBizDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParallelism($value)
    {
        $this->data['Parallelism'] = $value;
        $this->options['form_params']['Parallelism'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRootNodeId($value)
    {
        $this->data['RootNodeId'] = $value;
        $this->options['form_params']['RootNodeId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizBeginTime($value)
    {
        $this->data['BizBeginTime'] = $value;
        $this->options['form_params']['BizBeginTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndBizDate($value)
    {
        $this->data['EndBizDate'] = $value;
        $this->options['form_params']['EndBizDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIncludeNodeIds($value)
    {
        $this->data['IncludeNodeIds'] = $value;
        $this->options['form_params']['IncludeNodeIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizEndTime($value)
    {
        $this->data['BizEndTime'] = $value;
        $this->options['form_params']['BizEndTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExcludeNodeIds($value)
    {
        $this->data['ExcludeNodeIds'] = $value;
        $this->options['form_params']['ExcludeNodeIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeParams($value)
    {
        $this->data['NodeParams'] = $value;
        $this->options['form_params']['NodeParams'] = $value;

        return $this;
    }
}
