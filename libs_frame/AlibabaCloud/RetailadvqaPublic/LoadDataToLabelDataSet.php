<?php

namespace AlibabaCloud\RetailadvqaPublic;

/**
 * @method string getAccessId()
 * @method $this withAccessId($value)
 * @method string getSeparator()
 * @method $this withSeparator($value)
 * @method string getOssPath()
 * @method $this withOssPath($value)
 * @method string getCubeId()
 * @method $this withCubeId($value)
 * @method array getColNameList()
 */
class LoadDataToLabelDataSet extends Rpc
{
    /**
     * @return $this
     */
    public function withColNameList(array $colNameList)
    {
        $this->data['ColNameList'] = $colNameList;
        foreach ($colNameList as $i => $iValue) {
            $this->options['query']['ColNameList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
