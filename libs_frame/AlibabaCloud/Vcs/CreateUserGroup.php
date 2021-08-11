<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsvSubId()
 * @method string getCorpId()
 * @method string getUserGroupName()
 * @method string getParentUserGroupId()
 */
class CreateUserGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsvSubId($value)
    {
        $this->data['IsvSubId'] = $value;
        $this->options['form_params']['IsvSubId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserGroupName($value)
    {
        $this->data['UserGroupName'] = $value;
        $this->options['form_params']['UserGroupName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParentUserGroupId($value)
    {
        $this->data['ParentUserGroupId'] = $value;
        $this->options['form_params']['ParentUserGroupId'] = $value;

        return $this;
    }
}
