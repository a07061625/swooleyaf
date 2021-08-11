<?php

namespace AlibabaCloud\LinkFace;

/**
 * @method string getLicenseType()
 * @method string getPageSize()
 * @method string getCurrentPage()
 */
class QueryLicenses extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLicenseType($value)
    {
        $this->data['LicenseType'] = $value;
        $this->options['form_params']['LicenseType'] = $value;

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
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['form_params']['CurrentPage'] = $value;

        return $this;
    }
}
