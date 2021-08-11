<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getResourceGroupName()
 * @method $this withResourceGroupName($value)
 * @method string getEnableSubscribeEvent()
 * @method $this withEnableSubscribeEvent($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getEnableInstallAgent()
 * @method $this withEnableInstallAgent($value)
 * @method array getContactGroupList()
 */
class CreateMonitorGroupByResourceGroupId extends Rpc
{
    /**
     * @return $this
     */
    public function withContactGroupList(array $contactGroupList)
    {
        $this->data['ContactGroupList'] = $contactGroupList;
        foreach ($contactGroupList as $i => $iValue) {
            $this->options['query']['ContactGroupList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
