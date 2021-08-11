<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getSource()
 * @method $this withSource($value)
 * @method string getContainerFieldName()
 * @method $this withContainerFieldName($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getContainerFieldValue()
 * @method $this withContainerFieldValue($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getFrom()
 * @method $this withFrom($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getAlarmUniqueInfo()
 * @method $this withAlarmUniqueInfo($value)
 * @method string getUniqueInfo()
 * @method $this withUniqueInfo($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getDealed()
 * @method $this withDealed($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getOperateErrorCodeList()
 * @method string getName()
 * @method $this withName($value)
 * @method string getLevels()
 * @method $this withLevels($value)
 * @method string getParentEventTypes()
 * @method $this withParentEventTypes($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 * @method string getUuids()
 * @method $this withUuids($value)
 */
class DescribeSuspEvents extends Rpc
{
    /**
     * @return $this
     */
    public function withOperateErrorCodeList(array $operateErrorCodeList)
    {
        $this->data['OperateErrorCodeList'] = $operateErrorCodeList;
        foreach ($operateErrorCodeList as $i => $iValue) {
            $this->options['query']['OperateErrorCodeList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
