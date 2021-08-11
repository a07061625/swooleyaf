<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method array getUuidList()
 * @method string getPolicy()
 * @method $this withPolicy($value)
 * @method string getPolicyVersion()
 * @method $this withPolicyVersion($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class CreateBackupPolicy extends Rpc
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
