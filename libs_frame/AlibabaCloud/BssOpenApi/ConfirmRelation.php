<?php

namespace AlibabaCloud\BssOpenApi;

/**
 * @method string getRelationType()
 * @method $this withRelationType($value)
 * @method string getParentUserId()
 * @method $this withParentUserId($value)
 * @method string getConfirmCode()
 * @method $this withConfirmCode($value)
 * @method string getChildUserId()
 * @method $this withChildUserId($value)
 * @method string getRequestId()
 * @method $this withRequestId($value)
 * @method array getPermissionCodes()
 */
class ConfirmRelation extends Rpc
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
}
