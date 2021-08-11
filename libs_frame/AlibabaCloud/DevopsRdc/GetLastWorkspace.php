<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getRealPk()
 * @method string getOrgId()
 */
class GetLastWorkspace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRealPk($value)
    {
        $this->data['RealPk'] = $value;
        $this->options['form_params']['RealPk'] = $value;

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
