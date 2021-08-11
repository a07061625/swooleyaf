<?php

namespace AlibabaCloud\RetailadvqaPublic;

/**
 * @method string getAccessId()
 * @method $this withAccessId($value)
 * @method string getDsId()
 * @method $this withDsId($value)
 * @method array getDatasetLabelList()
 * @method string getCubeName()
 * @method $this withCubeName($value)
 * @method string getTableName()
 * @method $this withTableName($value)
 * @method string getCubeId()
 * @method $this withCubeId($value)
 * @method string getWorkspaceId()
 * @method $this withWorkspaceId($value)
 */
class SaveLabelDataSet extends Rpc
{
    /**
     * @return $this
     */
    public function withDatasetLabelList(array $datasetLabelList)
    {
        $this->data['DatasetLabelList'] = $datasetLabelList;
        foreach ($datasetLabelList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ColumnComment'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.ColumnComment'] = $depth1Value['ColumnComment'];
            }
            if (isset($depth1Value['MappingType'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.MappingType'] = $depth1Value['MappingType'];
            }
            if (isset($depth1Value['UniqueIdentification'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.UniqueIdentification'] = $depth1Value['UniqueIdentification'];
            }
            if (isset($depth1Value['Remark'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.Remark'] = $depth1Value['Remark'];
            }
            if (isset($depth1Value['ColumnName'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.ColumnName'] = $depth1Value['ColumnName'];
            }
            if (isset($depth1Value['ColumnType'])) {
                $this->options['query']['DatasetLabelList.' . ($depth1 + 1) . '.ColumnType'] = $depth1Value['ColumnType'];
            }
        }

        return $this;
    }
}
