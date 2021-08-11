<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getLaunchTemplateName()
 * @method $this withLaunchTemplateName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getDeleteVersion()
 * @method string getLaunchTemplateId()
 * @method $this withLaunchTemplateId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteLaunchTemplateVersion extends Rpc
{
    /**
     * @return $this
     */
    public function withDeleteVersion(array $deleteVersion)
    {
        $this->data['DeleteVersion'] = $deleteVersion;
        foreach ($deleteVersion as $i => $iValue) {
            $this->options['query']['DeleteVersion.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
