<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getActive()
 * @method $this withActive($value)
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbName()
 * @method $this withDbName($value)
 * @method array getTableName()
 */
class SetupBroadcastTables extends Rpc
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
