<?php

namespace AlibabaCloud\ROS;

/**
 * @method array getExecutionStatus()
 * @method array getChangeSetName()
 * @method string getStackId()
 * @method $this withStackId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getStatus()
 */
class ListChangeSets extends Rpc
{
    /**
     * @return $this
     */
    public function withExecutionStatus(array $executionStatus)
    {
        $this->data['ExecutionStatus'] = $executionStatus;
        foreach ($executionStatus as $i => $iValue) {
            $this->options['query']['ExecutionStatus.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withChangeSetName(array $changeSetName)
    {
        $this->data['ChangeSetName'] = $changeSetName;
        foreach ($changeSetName as $i => $iValue) {
            $this->options['query']['ChangeSetName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withStatus(array $status)
    {
        $this->data['Status'] = $status;
        foreach ($status as $i => $iValue) {
            $this->options['query']['Status.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
