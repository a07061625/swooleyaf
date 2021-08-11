<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getFileName()
 * @method $this withFileName($value)
 * @method array getDataSchemaStatusList()
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getFileId()
 * @method $this withFileId($value)
 */
class DescribeFile extends Rpc
{
    /**
     * @return $this
     */
    public function withDataSchemaStatusList(array $dataSchemaStatusList)
    {
        $this->data['DataSchemaStatusList'] = $dataSchemaStatusList;
        foreach ($dataSchemaStatusList as $i => $iValue) {
            $this->options['query']['DataSchemaStatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
