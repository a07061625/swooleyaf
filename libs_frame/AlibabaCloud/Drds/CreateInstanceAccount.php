<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method array getDbPrivilege()
 */
class CreateInstanceAccount extends Rpc
{
    /**
     * @return $this
     */
    public function withDbPrivilege(array $dbPrivilege)
    {
        $this->data['DbPrivilege'] = $dbPrivilege;
        foreach ($dbPrivilege as $depth1 => $depth1Value) {
            if (isset($depth1Value['DbName'])) {
                $this->options['query']['DbPrivilege.' . ($depth1 + 1) . '.DbName'] = $depth1Value['DbName'];
            }
            if (isset($depth1Value['Privilege'])) {
                $this->options['query']['DbPrivilege.' . ($depth1 + 1) . '.Privilege'] = $depth1Value['Privilege'];
            }
        }

        return $this;
    }
}
