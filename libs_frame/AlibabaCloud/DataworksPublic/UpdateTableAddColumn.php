<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTableGuid()
 * @method $this withTableGuid($value)
 * @method array getColumn()
 */
class UpdateTableAddColumn extends Rpc
{
    /**
     * @return $this
     */
    public function withColumn(array $column)
    {
        $this->data['Column'] = $column;
        foreach ($column as $depth1 => $depth1Value) {
            if (isset($depth1Value['ColumnNameCn'])) {
                $this->options['form_params']['Column.' . ($depth1 + 1) . '.ColumnNameCn'] = $depth1Value['ColumnNameCn'];
            }
            if (isset($depth1Value['Comment'])) {
                $this->options['form_params']['Column.' . ($depth1 + 1) . '.Comment'] = $depth1Value['Comment'];
            }
            if (isset($depth1Value['ColumnName'])) {
                $this->options['form_params']['Column.' . ($depth1 + 1) . '.ColumnName'] = $depth1Value['ColumnName'];
            }
            if (isset($depth1Value['ColumnType'])) {
                $this->options['form_params']['Column.' . ($depth1 + 1) . '.ColumnType'] = $depth1Value['ColumnType'];
            }
        }

        return $this;
    }
}
