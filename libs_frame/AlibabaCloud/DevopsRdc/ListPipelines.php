<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getPipelineName()
 * @method string getResultStatusList()
 * @method string getCreators()
 * @method string getExecuteEndTime()
 * @method string getUserPk()
 * @method string getOrgId()
 * @method $this withOrgId($value)
 * @method string getCreateStartTime()
 * @method string getOperators()
 * @method string getPageSize()
 * @method string getExecuteStartTime()
 * @method string getPageStart()
 * @method string getCreateEndTime()
 */
class ListPipelines extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPipelineName($value)
    {
        $this->data['PipelineName'] = $value;
        $this->options['form_params']['PipelineName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResultStatusList($value)
    {
        $this->data['ResultStatusList'] = $value;
        $this->options['form_params']['ResultStatusList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreators($value)
    {
        $this->data['Creators'] = $value;
        $this->options['form_params']['Creators'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExecuteEndTime($value)
    {
        $this->data['ExecuteEndTime'] = $value;
        $this->options['form_params']['ExecuteEndTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateStartTime($value)
    {
        $this->data['CreateStartTime'] = $value;
        $this->options['form_params']['CreateStartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperators($value)
    {
        $this->data['Operators'] = $value;
        $this->options['form_params']['Operators'] = $value;

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
    public function withExecuteStartTime($value)
    {
        $this->data['ExecuteStartTime'] = $value;
        $this->options['form_params']['ExecuteStartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageStart($value)
    {
        $this->data['PageStart'] = $value;
        $this->options['form_params']['PageStart'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreateEndTime($value)
    {
        $this->data['CreateEndTime'] = $value;
        $this->options['form_params']['CreateEndTime'] = $value;

        return $this;
    }
}
