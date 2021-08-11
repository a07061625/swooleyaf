<?php

namespace AlibabaCloud\TeambitionAliyun;

/**
 * @method string getNote()
 * @method string getVisible()
 * @method string getExecutorId()
 * @method string getTaskFlowStatusId()
 * @method string getScenarioFiieldConfigId()
 * @method string getStartDate()
 * @method string getPriority()
 * @method string getParentTaskId()
 * @method string getOrgId()
 * @method string getContent()
 * @method string getSprintId()
 * @method string getDueDate()
 * @method string getProjectId()
 * @method string getTaskId()
 */
class UpdateProjectTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNote($value)
    {
        $this->data['Note'] = $value;
        $this->options['form_params']['Note'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVisible($value)
    {
        $this->data['Visible'] = $value;
        $this->options['form_params']['Visible'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExecutorId($value)
    {
        $this->data['ExecutorId'] = $value;
        $this->options['form_params']['ExecutorId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskFlowStatusId($value)
    {
        $this->data['TaskFlowStatusId'] = $value;
        $this->options['form_params']['TaskFlowStatusId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScenarioFiieldConfigId($value)
    {
        $this->data['ScenarioFiieldConfigId'] = $value;
        $this->options['form_params']['ScenarioFiieldConfigId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartDate($value)
    {
        $this->data['StartDate'] = $value;
        $this->options['form_params']['StartDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPriority($value)
    {
        $this->data['Priority'] = $value;
        $this->options['form_params']['Priority'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentTaskId($value)
    {
        $this->data['ParentTaskId'] = $value;
        $this->options['form_params']['ParentTaskId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSprintId($value)
    {
        $this->data['SprintId'] = $value;
        $this->options['form_params']['SprintId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDueDate($value)
    {
        $this->data['DueDate'] = $value;
        $this->options['form_params']['DueDate'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskId($value)
    {
        $this->data['TaskId'] = $value;
        $this->options['form_params']['TaskId'] = $value;

        return $this;
    }
}
