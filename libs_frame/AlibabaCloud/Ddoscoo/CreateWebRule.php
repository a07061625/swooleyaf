<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getHttpsExt()
 * @method $this withHttpsExt($value)
 * @method string getRules()
 * @method $this withRules($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getRsType()
 * @method $this withRsType($value)
 * @method string getDefenseId()
 * @method $this withDefenseId($value)
 * @method array getInstanceIds()
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class CreateWebRule extends Rpc
{
    /**
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
