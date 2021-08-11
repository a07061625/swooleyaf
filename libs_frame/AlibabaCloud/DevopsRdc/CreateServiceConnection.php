<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getServiceConnectionType()
 * @method string getUserPk()
 * @method string getOrgId()
 */
class CreateServiceConnection extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceConnectionType($value)
    {
        $this->data['ServiceConnectionType'] = $value;
        $this->options['form_params']['ServiceConnectionType'] = $value;

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
