<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getIncludeListener()
 * @method $this withIncludeListener($value)
 * @method string getTLSCipherPolicyId()
 * @method $this withTLSCipherPolicyId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getMaxItems()
 * @method $this withMaxItems($value)
 */
class ListTLSCipherPolicies extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }
}
