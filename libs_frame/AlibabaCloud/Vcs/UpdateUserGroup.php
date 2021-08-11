<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsvSubId()
 * @method string getCorpId()
 * @method string getUserGroupId()
 * @method string getUserGroupName()
 */
class UpdateUserGroup extends Rpc
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
    public function withUserGroupId($value)
    {
        $this->data['UserGroupId'] = $value;
        $this->options['form_params']['UserGroupId'] = $value;

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
}
