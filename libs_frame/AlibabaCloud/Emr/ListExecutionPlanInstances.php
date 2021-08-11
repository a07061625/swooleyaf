<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getOnlyLastInstance()
 * @method $this withOnlyLastInstance($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getExecutionPlanIdList()
 * @method array getStatusList()
 * @method string getIsDesc()
 * @method $this withIsDesc($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class ListExecutionPlanInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withExecutionPlanIdList(array $executionPlanIdList)
    {
        $this->data['ExecutionPlanIdList'] = $executionPlanIdList;
        foreach ($executionPlanIdList as $i => $iValue) {
            $this->options['query']['ExecutionPlanIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withStatusList(array $statusList)
    {
        $this->data['StatusList'] = $statusList;
        foreach ($statusList as $i => $iValue) {
            $this->options['query']['StatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
