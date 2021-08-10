<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getSmartGroupId()
 * @method string getName()
 * @method string getDescription()
 * @method string getProjectId()
 * @method string getOrgId()
 */
class CreateCommonGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSmartGroupId($value)
    {
        $this->data['SmartGroupId'] = $value;
        $this->options['form_params']['SmartGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

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
