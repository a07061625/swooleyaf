<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getSelectBy()
 * @method string getPageSize()
 * @method string getOrderBy()
 * @method string getOrgId()
 * @method string getPageToken()
 */
class ListDevopsProjects extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectBy($value)
    {
        $this->data['SelectBy'] = $value;
        $this->options['form_params']['SelectBy'] = $value;

        return $this;
    }

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
    public function withOrderBy($value)
    {
        $this->data['OrderBy'] = $value;
        $this->options['form_params']['OrderBy'] = $value;

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
