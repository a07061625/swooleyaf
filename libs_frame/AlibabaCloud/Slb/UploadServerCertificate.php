<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getServerCertificate()
 * @method $this withServerCertificate($value)
 * @method string getAliCloudCertificateName()
 * @method $this withAliCloudCertificateName($value)
 * @method string getAliCloudCertificateId()
 * @method $this withAliCloudCertificateId($value)
 * @method string getPrivateKey()
 * @method $this withPrivateKey($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getStandardType()
 * @method $this withStandardType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getAliCloudCertificateRegionId()
 * @method $this withAliCloudCertificateRegionId($value)
 * @method string getServerCertificateName()
 * @method $this withServerCertificateName($value)
 */
class UploadServerCertificate extends Rpc
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
