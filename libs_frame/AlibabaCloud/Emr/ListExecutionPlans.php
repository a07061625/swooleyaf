<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getStatusList()
 * @method string getIsDesc()
 * @method $this withIsDesc($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getQueryType()
 * @method $this withQueryType($value)
 * @method string getQueryString()
 * @method $this withQueryString($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getStrategy()
 * @method $this withStrategy($value)
 */
class ListExecutionPlans extends Rpc
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
