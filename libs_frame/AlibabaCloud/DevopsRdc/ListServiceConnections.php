<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getScType()
 * @method string getUserPk()
 * @method string getOrgId()
 */
class ListServiceConnections extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScType($value)
    {
        $this->data['ScType'] = $value;
        $this->options['form_params']['ScType'] = $value;

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
