<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getUser()
 */
class DeleteUsers extends Rpc
{
    /**
     * @return $this
     */
    public function withUser(array $user)
    {
        $this->data['User'] = $user;
        foreach ($user as $depth1 => $depth1Value) {
            if (isset($depth1Value['Name'])) {
                $this->options['query']['User.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            }
        }

        return $this;
    }
}
