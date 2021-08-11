<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getStatusList()
 * @method $this withStatusList($value)
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getVpcInstanceIds()
 * @method $this withVpcInstanceIds($value)
 * @method array getVulNames()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getTag()
 * @method $this withTag($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getLevel()
 * @method $this withLevel($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getDealed()
 * @method $this withDealed($value)
 * @method string getFieldValue()
 * @method $this withFieldValue($value)
 * @method string getFieldName()
 * @method $this withFieldName($value)
 * @method string getSearchTags()
 * @method $this withSearchTags($value)
 * @method string getNecessity()
 * @method $this withNecessity($value)
 */
class DescribeUuidsByVulNames extends Rpc
{
    /**
     * @return $this
     */
    public function withVulNames(array $vulNames)
    {
        $this->data['VulNames'] = $vulNames;
        foreach ($vulNames as $i => $iValue) {
            $this->options['query']['VulNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
