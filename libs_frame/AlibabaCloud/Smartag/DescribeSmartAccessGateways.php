<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAclIds()
 * @method $this withAclIds($value)
 * @method string getCanAssociateQos()
 * @method $this withCanAssociateQos($value)
 * @method string getSoftwareVersion()
 * @method $this withSoftwareVersion($value)
 * @method string getUnboundAclIds()
 * @method $this withUnboundAclIds($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getVersionComparator()
 * @method $this withVersionComparator($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getInstanceType()
 * @method $this withInstanceType($value)
 * @method string getHardwareType()
 * @method $this withHardwareType($value)
 * @method array getSmartAGIds()
 * @method string getSerialNumber()
 * @method $this withSerialNumber($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getAssociatedCcnId()
 * @method $this withAssociatedCcnId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBusinessState()
 * @method $this withBusinessState($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getSmartAGId()
 * @method $this withSmartAGId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeSmartAccessGateways extends Rpc
{
    /**
     * @return $this
     */
    public function withSmartAGIds(array $smartAGIds)
    {
        $this->data['SmartAGIds'] = $smartAGIds;
        foreach ($smartAGIds as $i => $iValue) {
            $this->options['query']['SmartAGIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
