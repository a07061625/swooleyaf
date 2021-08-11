<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getDescription()
 * @method string getCommonGroupId()
 * @method string getOrgId()
 * @method string getSmartGroupId()
 * @method string getName()
 * @method string getProjectId()
 */
class UpdateCommonGroup extends Rpc
{
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
    public function withCommonGroupId($value)
    {
        $this->data['CommonGroupId'] = $value;
        $this->options['form_params']['CommonGroupId'] = $value;

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
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
