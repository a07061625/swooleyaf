<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method array getUserInfo()
 */
class CreateUsers extends Rpc
{
    /**
     * @return $this
     */
    public function withUserInfo(array $userInfo)
    {
        $this->data['UserInfo'] = $userInfo;
        foreach ($userInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['Type'])) {
                $this->options['query']['UserInfo.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['UserId'])) {
                $this->options['query']['UserInfo.' . ($depth1 + 1) . '.UserId'] = $depth1Value['UserId'];
            }
            if (isset($depth1Value['UserName'])) {
                $this->options['query']['UserInfo.' . ($depth1 + 1) . '.UserName'] = $depth1Value['UserName'];
            }
        }

        return $this;
    }
}
