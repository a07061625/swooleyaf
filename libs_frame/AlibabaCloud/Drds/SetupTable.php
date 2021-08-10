<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getAllowFullTableScan()
 * @method $this withAllowFullTableScan($value)
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbName()
 * @method $this withDbName($value)
 * @method array getTableName()
 */
class SetupTable extends Rpc
{
    /**
     * @return $this
     */
    public function withTableName(array $tableName)
    {
        $this->data['TableName'] = $tableName;
        foreach ($tableName as $i => $iValue) {
            $this->options['query']['TableName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
