<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getInvolveMembers()
 * @method string getExecutorId()
 * @method string getOrderCondition()
 * @method string getSprintId()
 * @method string getExtra()
 * @method string getPageSize()
 * @method string getScenarioFieldConfigId()
 * @method string getIsDone()
 * @method string getObjectType()
 * @method string getProjectId()
 * @method string getPageToken()
 * @method string getOrder()
 * @method string getTagId()
 * @method string getTaskFlowStatusId()
 * @method string getDueDateStart()
 * @method string getCreatorId()
 * @method string getPriority()
 * @method string getDueDateEnd()
 * @method string getOrgId()
 * @method string getName()
 */
class GetTaskListFilter extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInvolveMembers($value)
    {
        $this->data['InvolveMembers'] = $value;
        $this->options['form_params']['InvolveMembers'] = $value;

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
    public function withOrderCondition($value)
    {
        $this->data['OrderCondition'] = $value;
        $this->options['form_params']['OrderCondition'] = $value;

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
    public function withExtra($value)
    {
        $this->data['Extra'] = $value;
        $this->options['form_params']['Extra'] = $value;

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
    public function withScenarioFieldConfigId($value)
    {
        $this->data['ScenarioFieldConfigId'] = $value;
        $this->options['form_params']['ScenarioFieldConfigId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsDone($value)
    {
        $this->data['IsDone'] = $value;
        $this->options['form_params']['IsDone'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withObjectType($value)
    {
        $this->data['ObjectType'] = $value;
        $this->options['form_params']['ObjectType'] = $value;

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
    public function withPageToken($value)
    {
        $this->data['PageToken'] = $value;
        $this->options['form_params']['PageToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrder($value)
    {
        $this->data['Order'] = $value;
        $this->options['form_params']['Order'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTagId($value)
    {
        $this->data['TagId'] = $value;
        $this->options['form_params']['TagId'] = $value;

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
    public function withDueDateStart($value)
    {
        $this->data['DueDateStart'] = $value;
        $this->options['form_params']['DueDateStart'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreatorId($value)
    {
        $this->data['CreatorId'] = $value;
        $this->options['form_params']['CreatorId'] = $value;

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
    public function withDueDateEnd($value)
    {
        $this->data['DueDateEnd'] = $value;
        $this->options['form_params']['DueDateEnd'] = $value;

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
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }
}
