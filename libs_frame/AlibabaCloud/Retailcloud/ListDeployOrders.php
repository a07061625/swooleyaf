<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getStartTimeGreaterThanOrEqualTo()
 * @method $this withStartTimeGreaterThanOrEqualTo($value)
 * @method array getStatusList()
 * @method string getEnvId()
 * @method $this withEnvId($value)
 * @method string getEndTimeGreaterThan()
 * @method $this withEndTimeGreaterThan($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPauseType()
 * @method $this withPauseType($value)
 * @method array getResultList()
 * @method string getStartTimeGreaterThan()
 * @method $this withStartTimeGreaterThan($value)
 * @method string getStartTimeLessThan()
 * @method $this withStartTimeLessThan($value)
 * @method string getStartTimeLessThanOrEqualTo()
 * @method $this withStartTimeLessThanOrEqualTo($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getEndTimeGreaterThanOrEqualTo()
 * @method $this withEndTimeGreaterThanOrEqualTo($value)
 * @method string getEndTimeLessThan()
 * @method $this withEndTimeLessThan($value)
 * @method string getEndTimeLessThanOrEqualTo()
 * @method $this withEndTimeLessThanOrEqualTo($value)
 * @method string getPartitionType()
 * @method $this withPartitionType($value)
 * @method string getDeployCategory()
 * @method $this withDeployCategory($value)
 * @method string getDeployType()
 * @method $this withDeployType($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListDeployOrders extends Rpc
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
