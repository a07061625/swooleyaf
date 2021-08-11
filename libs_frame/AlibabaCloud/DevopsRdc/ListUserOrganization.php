<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getRealPk()
 */
class ListUserOrganization extends Rpc
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
}
