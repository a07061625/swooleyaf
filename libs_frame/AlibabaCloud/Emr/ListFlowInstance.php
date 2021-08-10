<?php

namespace AlibabaCloud\Emr;

/**
 * @method array getStatusList()
 * @method string getNodeInstanceId()
 * @method $this withNodeInstanceId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getOwner()
 * @method $this withOwner($value)
 * @method string getTimeRange()
 * @method $this withTimeRange($value)
 * @method string getOrderBy()
 * @method $this withOrderBy($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getFlowName()
 * @method $this withFlowName($value)
 * @method string getFlowId()
 * @method $this withFlowId($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class ListFlowInstance extends Rpc
{
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
