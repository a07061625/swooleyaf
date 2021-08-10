<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method array getStatusList()
 * @method string getDeployOrderId()
 * @method $this withDeployOrderId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getResultList()
 */
class ListPods extends Rpc
{
    /**
     * @return $this
     */
    public function withStatusList(array $statusList)
    {
        $this->data['StatusList'] = $statusList;
        foreach ($statusList as $i => $iValue) {
            $this->options['form_params']['StatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withResultList(array $resultList)
    {
        $this->data['ResultList'] = $resultList;
        foreach ($resultList as $i => $iValue) {
            $this->options['form_params']['ResultList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
