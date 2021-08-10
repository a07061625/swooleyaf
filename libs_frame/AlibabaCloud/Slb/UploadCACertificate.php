<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getCACertificateName()
 * @method $this withCACertificateName($value)
 * @method string getCACertificate()
 * @method $this withCACertificate($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getStandardType()
 * @method $this withStandardType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class UploadCACertificate extends Rpc
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
