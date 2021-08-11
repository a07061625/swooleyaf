<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getChildNick()
 * @method $this withChildNick($value)
 * @method string getRelationType()
 * @method $this withRelationType($value)
 * @method string getParentUserId()
 * @method $this withParentUserId($value)
 * @method string getChildUserId()
 * @method $this withChildUserId($value)
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method array getPermissionCodes()
 * @method array getRoleCodes()
 */
class AddAccountRelation extends Rpc
{
    /**
     * @return $this
     */
    public function withPermissionCodes(array $permissionCodes)
    {
        $this->data['PermissionCodes'] = $permissionCodes;
        foreach ($permissionCodes as $i => $iValue) {
            $this->options['query']['PermissionCodes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withRoleCodes(array $roleCodes)
    {
        $this->data['RoleCodes'] = $roleCodes;
        foreach ($roleCodes as $i => $iValue) {
            $this->options['query']['RoleCodes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
