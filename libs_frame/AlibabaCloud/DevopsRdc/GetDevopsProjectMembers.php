<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getPageSize()
 * @method string getProjectId()
 * @method string getOrgId()
 * @method string getPageToken()
 */
class GetDevopsProjectMembers extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageToken($value)
    {
        $this->data['PageToken'] = $value;
        $this->options['form_params']['PageToken'] = $value;

        return $this;
    }
}
