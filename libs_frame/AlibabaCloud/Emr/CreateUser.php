<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getUserType()
 * @method $this withUserType($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getUserAccountParamList()
 * @method array getGroupIdList()
 * @method array getRoleIdList()
 * @method string getAliyunUserId()
 * @method $this withAliyunUserId($value)
 * @method string getUserName()
 * @method $this withUserName($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class CreateUser extends Rpc
{
    /**
     * @return $this
     */
    public function withUserAccountParamList(array $userAccountParamList)
    {
        $this->data['UserAccountParamList'] = $userAccountParamList;
        foreach ($userAccountParamList as $depth1 => $depth1Value) {
            if (isset($depth1Value['AccountType'])) {
                $this->options['query']['UserAccountParamList.' . ($depth1 + 1) . '.AccountType'] = $depth1Value['AccountType'];
            }
            if (isset($depth1Value['AuthType'])) {
                $this->options['query']['UserAccountParamList.' . ($depth1 + 1) . '.AuthType'] = $depth1Value['AuthType'];
            }
            if (isset($depth1Value['AccountPassword'])) {
                $this->options['query']['UserAccountParamList.' . ($depth1 + 1) . '.AccountPassword'] = $depth1Value['AccountPassword'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withGroupIdList(array $groupIdList)
    {
        $this->data['GroupIdList'] = $groupIdList;
        foreach ($groupIdList as $i => $iValue) {
            $this->options['query']['GroupIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withRoleIdList(array $roleIdList)
    {
        $this->data['RoleIdList'] = $roleIdList;
        foreach ($roleIdList as $i => $iValue) {
            $this->options['query']['RoleIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
