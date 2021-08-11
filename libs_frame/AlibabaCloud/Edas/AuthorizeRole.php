<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getRoleIds()
 * @method string getTargetUserId()
 */
class AuthorizeRole extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/authorize_role';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoleIds($value)
    {
        $this->data['RoleIds'] = $value;
        $this->options['query']['RoleIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUserId($value)
    {
        $this->data['TargetUserId'] = $value;
        $this->options['query']['TargetUserId'] = $value;

        return $this;
    }
}
