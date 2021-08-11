<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getClientToken()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getDisplayName()
 * @method string getSkillGroupId()
 * @method string getSkillGroupIdList()
 */
class CreateAgent extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccountName($value)
    {
        $this->data['AccountName'] = $value;
        $this->options['form_params']['AccountName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDisplayName($value)
    {
        $this->data['DisplayName'] = $value;
        $this->options['form_params']['DisplayName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSkillGroupId($value)
    {
        $this->data['SkillGroupId'] = $value;
        $this->options['form_params']['SkillGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSkillGroupIdList($value)
    {
        $this->data['SkillGroupIdList'] = $value;
        $this->options['form_params']['SkillGroupIdList'] = $value;

        return $this;
    }
}
