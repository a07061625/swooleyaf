<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getOrgName()
 * @method string getTracerId()
 * @method string getDataFormat()
 * @method string getOrgId()
 * @method string getImageUrl()
 */
class DetectHipKeypointXRay extends Rpc
{
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTracerId($value)
    {
        $this->data['TracerId'] = $value;
        $this->options['form_params']['TracerId'] = $value;

        return $this;
    }

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
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['form_params']['ImageUrl'] = $value;

        return $this;
    }
}
