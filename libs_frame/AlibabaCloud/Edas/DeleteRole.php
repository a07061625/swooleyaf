<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getRoleId()
 */
class DeleteRole extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/delete_role';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoleId($value)
    {
        $this->data['RoleId'] = $value;
        $this->options['query']['RoleId'] = $value;

        return $this;
    }
}
