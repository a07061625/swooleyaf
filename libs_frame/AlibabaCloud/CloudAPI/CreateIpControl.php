<?php

namespace AlibabaCloud\CloudAPI;

/**
 * @method string getIpControlName()
 * @method $this withIpControlName($value)
 * @method array getIpControlPolicys()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getIpControlType()
 * @method $this withIpControlType($value)
 */
class CreateIpControl extends Rpc
{
    /**
     * @return $this
     */
    public function withIpControlPolicys(array $ipControlPolicys)
    {
        $this->data['IpControlPolicys'] = $ipControlPolicys;
        foreach ($ipControlPolicys as $depth1 => $depth1Value) {
            $this->options['query']['IpControlPolicys.' . ($depth1 + 1) . '.AppId'] = $depth1Value['AppId'];
            $this->options['query']['IpControlPolicys.' . ($depth1 + 1) . '.CidrIp'] = $depth1Value['CidrIp'];
        }

        return $this;
    }
}
