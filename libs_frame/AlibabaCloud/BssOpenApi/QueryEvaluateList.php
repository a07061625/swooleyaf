<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getEndSearchTime()
 * @method $this withEndSearchTime($value)
 * @method string getOutBizId()
 * @method $this withOutBizId($value)
 * @method string getSortType()
 * @method $this withSortType($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getEndAmount()
 * @method $this withEndAmount($value)
 * @method string getBillCycle()
 * @method $this withBillCycle($value)
 * @method array getBizTypeList()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getStartSearchTime()
 * @method $this withStartSearchTime($value)
 * @method string getEndBizTime()
 * @method $this withEndBizTime($value)
 * @method string getStartAmount()
 * @method $this withStartAmount($value)
 * @method string getStartBizTime()
 * @method $this withStartBizTime($value)
 */
class QueryEvaluateList extends Rpc
{
    /**
     * @return $this
     */
    public function withBizTypeList(array $bizTypeList)
    {
        $this->data['BizTypeList'] = $bizTypeList;
        foreach ($bizTypeList as $i => $iValue) {
            $this->options['query']['BizTypeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
