<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDumpAllDatabase()
 * @method $this withDumpAllDatabase($value)
 * @method string getDumpLimit()
 * @method $this withDumpLimit($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getDumpAllTable()
 * @method $this withDumpAllTable($value)
 * @method array getPartitionValues()
 * @method string getTableId()
 * @method $this withTableId($value)
 * @method string getDatabaseId()
 * @method $this withDatabaseId($value)
 * @method string getDumpAllPartition()
 * @method $this withDumpAllPartition($value)
 */
class DumpMetaDataSourceForOuter extends Rpc
{
    /**
     * @return $this
     */
    public function withPartitionValues(array $partitionValues)
    {
        $this->data['PartitionValues'] = $partitionValues;
        foreach ($partitionValues as $i => $iValue) {
            $this->options['query']['PartitionValues.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
