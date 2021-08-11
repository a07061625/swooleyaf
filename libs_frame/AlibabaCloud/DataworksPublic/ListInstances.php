<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getProjectEnv()
 * @method string getOwner()
 * @method string getBizName()
 * @method string getBeginBizdate()
 * @method string getEndBizdate()
 * @method string getDagId()
 * @method string getPageNumber()
 * @method string getNodeName()
 * @method string getProgramType()
 * @method string getBizdate()
 * @method string getPageSize()
 * @method string getNodeId()
 * @method string getProjectId()
 */
class ListInstances extends Rpc
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
    public function withOwner($value)
    {
        $this->data['Owner'] = $value;
        $this->options['form_params']['Owner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizName($value)
    {
        $this->data['BizName'] = $value;
        $this->options['form_params']['BizName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeginBizdate($value)
    {
        $this->data['BeginBizdate'] = $value;
        $this->options['form_params']['BeginBizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndBizdate($value)
    {
        $this->data['EndBizdate'] = $value;
        $this->options['form_params']['EndBizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDagId($value)
    {
        $this->data['DagId'] = $value;
        $this->options['form_params']['DagId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeName($value)
    {
        $this->data['NodeName'] = $value;
        $this->options['form_params']['NodeName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProgramType($value)
    {
        $this->data['ProgramType'] = $value;
        $this->options['form_params']['ProgramType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizdate($value)
    {
        $this->data['Bizdate'] = $value;
        $this->options['form_params']['Bizdate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
