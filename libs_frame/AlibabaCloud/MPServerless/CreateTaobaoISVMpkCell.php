<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getLicenseNumber()
 * @method string getLicenseName()
 */
class CreateTaobaoISVMpkCell extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLicenseNumber($value)
    {
        $this->data['LicenseNumber'] = $value;
        $this->options['form_params']['LicenseNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLicenseName($value)
    {
        $this->data['LicenseName'] = $value;
        $this->options['form_params']['LicenseName'] = $value;

        return $this;
    }
}
