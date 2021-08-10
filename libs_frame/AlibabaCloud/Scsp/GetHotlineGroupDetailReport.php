<?php

namespace AlibabaCloud\Scsp;

/**
 * @method array getDepIds()
 * @method string getEndDate()
 * @method $this withEndDate($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method array getGroupIds()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getStartDate()
 * @method $this withStartDate($value)
 */
class GetHotlineGroupDetailReport extends Rpc
{
    /**
     * @return $this
     */
    public function withDepIds(array $depIds)
    {
        $this->data['DepIds'] = $depIds;
        foreach ($depIds as $i => $iValue) {
            $this->options['query']['DepIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withGroupIds(array $groupIds)
    {
        $this->data['GroupIds'] = $groupIds;
        foreach ($groupIds as $i => $iValue) {
            $this->options['query']['GroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
