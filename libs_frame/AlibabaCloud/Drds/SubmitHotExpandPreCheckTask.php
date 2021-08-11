<?php

namespace AlibabaCloud\Drds;

/**
 * @method array getTableList()
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbName()
 * @method $this withDbName($value)
 * @method string getDbInstType()
 * @method $this withDbInstType($value)
 */
class SubmitHotExpandPreCheckTask extends Rpc
{
    /**
     * @return $this
     */
    public function withTableList(array $tableList)
    {
        $this->data['TableList'] = $tableList;
        foreach ($tableList as $i => $iValue) {
            $this->options['query']['TableList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
