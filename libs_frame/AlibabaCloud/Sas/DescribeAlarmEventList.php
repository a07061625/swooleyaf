<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getAlarmEventType()
 * @method $this withAlarmEventType($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getContainerFieldName()
 * @method $this withContainerFieldName($value)
 * @method string getAlarmEventName()
 * @method $this withAlarmEventName($value)
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
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getDealed()
 * @method $this withDealed($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getOperateErrorCodeList()
 * @method string getLevels()
 * @method $this withLevels($value)
 */
class DescribeAlarmEventList extends Rpc
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
