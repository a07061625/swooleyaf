<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getAclId()
 * @method $this withAclId($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getAclEntries()
 */
class RemoveEntriesFromAcl extends Rpc
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
        }

        return $this;
    }
}
