<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method string getClientToken()
 * @method string getSkillGroupId()
 */
class RemoveSkillGroup extends Rpc
{
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
    public function withSkillGroupId($value)
    {
        $this->data['SkillGroupId'] = $value;
        $this->options['form_params']['SkillGroupId'] = $value;

        return $this;
    }
}
