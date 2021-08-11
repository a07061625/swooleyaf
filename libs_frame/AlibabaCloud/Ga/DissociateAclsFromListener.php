<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getAclIds()
 * @method string getListenerId()
 * @method $this withListenerId($value)
 */
class DissociateAclsFromListener extends Rpc
{
    /**
     * @return $this
     */
    public function withAclIds(array $aclIds)
    {
        $this->data['AclIds'] = $aclIds;
        foreach ($aclIds as $i => $iValue) {
            $this->options['query']['AclIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
