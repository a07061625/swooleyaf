<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getDataFormat()
 * @method string getUrl()
 * @method string getOrgId()
 * @method string getOrgName()
 */
class DetectKneeXRay extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataFormat($value)
    {
        $this->data['DataFormat'] = $value;
        $this->options['form_params']['DataFormat'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUrl($value)
    {
        $this->data['Url'] = $value;
        $this->options['form_params']['Url'] = $value;

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
    public function withOrgName($value)
    {
        $this->data['OrgName'] = $value;
        $this->options['form_params']['OrgName'] = $value;

        return $this;
    }
}
