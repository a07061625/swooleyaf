<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getRoleId()
 * @method string getActionData()
 */
class UpdateRole extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/edit_role';

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActionData($value)
    {
        $this->data['ActionData'] = $value;
        $this->options['query']['ActionData'] = $value;

        return $this;
    }
}
