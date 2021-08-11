<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getStackId()
 * @method $this withStackId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getLogicalResourceId()
 * @method array getResourceType()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getStatus()
 */
class ListStackEvents extends Rpc
{
    /**
     * @return $this
     */
    public function withLogicalResourceId(array $logicalResourceId)
    {
        $this->data['LogicalResourceId'] = $logicalResourceId;
        foreach ($logicalResourceId as $i => $iValue) {
            $this->options['query']['LogicalResourceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withResourceType(array $resourceType)
    {
        $this->data['ResourceType'] = $resourceType;
        foreach ($resourceType as $i => $iValue) {
            $this->options['query']['ResourceType.' . ($i + 1)] = $iValue;
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
