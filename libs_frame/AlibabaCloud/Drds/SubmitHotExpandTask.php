<?php

namespace AlibabaCloud\Drds;

/**
 * @method array getMapping()
 * @method string getTaskDesc()
 * @method $this withTaskDesc($value)
 * @method array getSupperAccountMapping()
 * @method array getExtendedMapping()
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method array getInstanceDbMapping()
 * @method string getDbName()
 * @method $this withDbName($value)
 */
class SubmitHotExpandTask extends Rpc
{
    /**
     * @return $this
     */
    public function withMapping(array $mapping)
    {
        $this->data['Mapping'] = $mapping;
        foreach ($mapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['DbShardColumn'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.DbShardColumn'] = $depth1Value['DbShardColumn'];
            }
            if (isset($depth1Value['TbShardColumn'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.TbShardColumn'] = $depth1Value['TbShardColumn'];
            }
            if (isset($depth1Value['ShardTbValue'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.ShardTbValue'] = $depth1Value['ShardTbValue'];
            }
            if (isset($depth1Value['HotDbName'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.HotDbName'] = $depth1Value['HotDbName'];
            }
            if (isset($depth1Value['ShardDbValue'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.ShardDbValue'] = $depth1Value['ShardDbValue'];
            }
            if (isset($depth1Value['HotTableName'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.HotTableName'] = $depth1Value['HotTableName'];
            }
            if (isset($depth1Value['LogicTable'])) {
                $this->options['query']['Mapping.' . ($depth1 + 1) . '.LogicTable'] = $depth1Value['LogicTable'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSupperAccountMapping(array $supperAccountMapping)
    {
        $this->data['SupperAccountMapping'] = $supperAccountMapping;
        foreach ($supperAccountMapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['InstanceName'])) {
                $this->options['query']['SupperAccountMapping.' . ($depth1 + 1) . '.InstanceName'] = $depth1Value['InstanceName'];
            }
            if (isset($depth1Value['SupperAccount'])) {
                $this->options['query']['SupperAccountMapping.' . ($depth1 + 1) . '.SupperAccount'] = $depth1Value['SupperAccount'];
            }
            if (isset($depth1Value['SupperPassword'])) {
                $this->options['query']['SupperAccountMapping.' . ($depth1 + 1) . '.SupperPassword'] = $depth1Value['SupperPassword'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withExtendedMapping(array $extendedMapping)
    {
        $this->data['ExtendedMapping'] = $extendedMapping;
        foreach ($extendedMapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['SrcInstanceId'])) {
                $this->options['query']['ExtendedMapping.' . ($depth1 + 1) . '.SrcInstanceId'] = $depth1Value['SrcInstanceId'];
            }
            if (isset($depth1Value['SrcDb'])) {
                $this->options['query']['ExtendedMapping.' . ($depth1 + 1) . '.SrcDb'] = $depth1Value['SrcDb'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceDbMapping(array $instanceDbMapping)
    {
        $this->data['InstanceDbMapping'] = $instanceDbMapping;
        foreach ($instanceDbMapping as $depth1 => $depth1Value) {
            if (isset($depth1Value['DbList'])) {
                $this->options['query']['InstanceDbMapping.' . ($depth1 + 1) . '.DbList'] = $depth1Value['DbList'];
            }
            if (isset($depth1Value['InstanceName'])) {
                $this->options['query']['InstanceDbMapping.' . ($depth1 + 1) . '.InstanceName'] = $depth1Value['InstanceName'];
            }
        }

        return $this;
    }
}
