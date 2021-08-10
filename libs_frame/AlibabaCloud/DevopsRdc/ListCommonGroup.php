<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getAll()
 * @method string getSmartGroupId()
 * @method string getProjectId()
 * @method string getOrgId()
 */
class ListCommonGroup extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAll($value)
    {
        $this->data['All'] = $value;
        $this->options['form_params']['All'] = $value;

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
