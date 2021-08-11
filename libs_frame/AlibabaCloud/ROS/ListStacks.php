<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getParentStackId()
 * @method $this withParentStackId($value)
 * @method string getShowNestedStack()
 * @method $this withShowNestedStack($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getStackName()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getStatus()
 */
class ListStacks extends Rpc
{
    /**
     * @return $this
     */
    public function withStackName(array $stackName)
    {
        $this->data['StackName'] = $stackName;
        foreach ($stackName as $i => $iValue) {
            $this->options['query']['StackName.' . ($i + 1)] = $iValue;
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
