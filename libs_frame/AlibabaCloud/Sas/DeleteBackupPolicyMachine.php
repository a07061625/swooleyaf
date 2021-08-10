<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPolicyVersion()
 * @method $this withPolicyVersion($value)
 * @method string getUuid()
 * @method $this withUuid($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPolicyId()
 * @method $this withPolicyId($value)
 * @method array getUuidList()
 */
class DeleteBackupPolicyMachine extends Rpc
{
    /**
     * @return $this
     */
    public function withUuidList(array $uuidList)
    {
        $this->data['UuidList'] = $uuidList;
        foreach ($uuidList as $i => $iValue) {
            $this->options['query']['UuidList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
