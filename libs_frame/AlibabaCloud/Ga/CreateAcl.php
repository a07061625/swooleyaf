<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getAclName()
 * @method $this withAclName($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getAclEntries()
 * @method string getAddressIPVersion()
 * @method $this withAddressIPVersion($value)
 */
class CreateAcl extends Rpc
{
    /**
     * @return $this
     */
    public function withAclEntries(array $aclEntries)
    {
        $this->data['AclEntries'] = $aclEntries;
        foreach ($aclEntries as $depth1 => $depth1Value) {
            if (isset($depth1Value['Entry'])) {
                $this->options['query']['AclEntries.' . ($depth1 + 1) . '.Entry'] = $depth1Value['Entry'];
            }
            if (isset($depth1Value['EntryDescription'])) {
                $this->options['query']['AclEntries.' . ($depth1 + 1) . '.EntryDescription'] = $depth1Value['EntryDescription'];
            }
        }

        return $this;
    }
}
