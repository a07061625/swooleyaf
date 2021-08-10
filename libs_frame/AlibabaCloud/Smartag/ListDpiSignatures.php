<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getDpiSignatureNames()
 * @method array getDpiSignatureIds()
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getDpiGroupId()
 * @method $this withDpiGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListDpiSignatures extends Rpc
{
    /**
     * @return $this
     */
    public function withDpiSignatureNames(array $dpiSignatureNames)
    {
        $this->data['DpiSignatureNames'] = $dpiSignatureNames;
        foreach ($dpiSignatureNames as $i => $iValue) {
            $this->options['query']['DpiSignatureNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDpiSignatureIds(array $dpiSignatureIds)
    {
        $this->data['DpiSignatureIds'] = $dpiSignatureIds;
        foreach ($dpiSignatureIds as $i => $iValue) {
            $this->options['query']['DpiSignatureIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
