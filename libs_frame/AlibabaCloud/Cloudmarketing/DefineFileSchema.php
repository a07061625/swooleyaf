<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method array getFileColumns()
 * @method string getFileId()
 * @method $this withFileId($value)
 */
class DefineFileSchema extends Rpc
{
    /**
     * @return $this
     */
    public function withFileColumns(array $fileColumns)
    {
        $this->data['FileColumns'] = $fileColumns;
        foreach ($fileColumns as $depth1 => $depth1Value) {
            $this->options['form_params']['FileColumns.' . ($depth1 + 1) . '.Head'] = $depth1Value['Head'];
            $this->options['form_params']['FileColumns.' . ($depth1 + 1) . '.DataType'] = $depth1Value['DataType'];
            $this->options['form_params']['FileColumns.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['form_params']['FileColumns.' . ($depth1 + 1) . '.Index'] = $depth1Value['Index'];
            $this->options['form_params']['FileColumns.' . ($depth1 + 1) . '.ColumnType'] = $depth1Value['ColumnType'];
        }

        return $this;
    }
}
