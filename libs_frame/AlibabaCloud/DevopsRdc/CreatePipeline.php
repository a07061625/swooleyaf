<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getPipeline()
 * @method string getUserPk()
 * @method string getOrgId()
 */
class CreatePipeline extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPipeline($value)
    {
        $this->data['Pipeline'] = $value;
        $this->options['form_params']['Pipeline'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }
}
