<?php

namespace AlibabaCloud\Linkedmall;

/**
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method array getItemIdList()
 * @method string getSubBizId()
 * @method $this withSubBizId($value)
 */
class DeleteBizItems extends Rpc
{
    /**
     * @return $this
     */
    public function withItemIdList(array $itemIdList)
    {
        $this->data['ItemIdList'] = $itemIdList;
        foreach ($itemIdList as $i => $iValue) {
            $this->options['query']['ItemIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
