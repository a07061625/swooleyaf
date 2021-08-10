<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getRoleName()
 * @method string getActionData()
 */
class InsertRole extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/create_role';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoleName($value)
    {
        $this->data['RoleName'] = $value;
        $this->options['query']['RoleName'] = $value;

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
