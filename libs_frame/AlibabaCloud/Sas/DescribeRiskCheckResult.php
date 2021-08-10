<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getAssetType()
 * @method $this withAssetType($value)
 * @method string getQueryFlag()
 * @method $this withQueryFlag($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method array getItemIds()
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getRiskLevel()
 * @method $this withRiskLevel($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeRiskCheckResult extends Rpc
{
    /**
     * @return $this
     */
    public function withItemIds(array $itemIds)
    {
        $this->data['ItemIds'] = $itemIds;
        foreach ($itemIds as $i => $iValue) {
            $this->options['query']['ItemIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
