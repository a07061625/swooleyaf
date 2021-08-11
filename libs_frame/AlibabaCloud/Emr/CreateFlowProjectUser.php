<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method array getUser()
 */
class CreateFlowProjectUser extends Rpc
{
    /**
     * @return $this
     */
    public function withUser(array $user)
    {
        $this->data['User'] = $user;
        foreach ($user as $depth1 => $depth1Value) {
            if (isset($depth1Value['UserId'])) {
                $this->options['query']['User.' . ($depth1 + 1) . '.UserId'] = $depth1Value['UserId'];
            }
            if (isset($depth1Value['UserName'])) {
                $this->options['query']['User.' . ($depth1 + 1) . '.UserName'] = $depth1Value['UserName'];
            }
        }

        return $this;
    }
}
