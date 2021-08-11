<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getNote()
 * @method string getExecutorId()
 * @method string getStartDate()
 * @method string getDelInvolvers()
 * @method string getContent()
 * @method string getSprintId()
 * @method string getCustomFieldId()
 * @method string getProjectId()
 * @method string getTaskId()
 * @method string getTaskFlowStatusId()
 * @method string getTagIds()
 * @method string getAddInvolvers()
 * @method string getPriority()
 * @method string getOrgId()
 * @method string getDueDate()
 * @method string getWorkTimes()
 * @method string getStoryPoint()
 * @method string getCustomFieldValues()
 */
class UpdateTaskDetail extends Rpc
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
    public function withDelInvolvers($value)
    {
        $this->data['DelInvolvers'] = $value;
        $this->options['form_params']['DelInvolvers'] = $value;

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
    public function withCustomFieldId($value)
    {
        $this->data['CustomFieldId'] = $value;
        $this->options['form_params']['CustomFieldId'] = $value;

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
    public function withTagIds($value)
    {
        $this->data['TagIds'] = $value;
        $this->options['form_params']['TagIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddInvolvers($value)
    {
        $this->data['AddInvolvers'] = $value;
        $this->options['form_params']['AddInvolvers'] = $value;

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
    public function withWorkTimes($value)
    {
        $this->data['WorkTimes'] = $value;
        $this->options['form_params']['WorkTimes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoryPoint($value)
    {
        $this->data['StoryPoint'] = $value;
        $this->options['form_params']['StoryPoint'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCustomFieldValues($value)
    {
        $this->data['CustomFieldValues'] = $value;
        $this->options['form_params']['CustomFieldValues'] = $value;

        return $this;
    }
}
