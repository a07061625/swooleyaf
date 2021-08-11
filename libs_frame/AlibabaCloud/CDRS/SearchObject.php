<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getShotTimeEnd()
 * @method string getCorpId()
 * @method string getPageNumber()
 * @method string getFeature()
 * @method string getVendor()
 * @method string getPageSize()
 * @method string getImageContent()
 * @method string getObjectType()
 * @method string getDeviceList()
 * @method string getImageUrl()
 * @method string getAttributes()
 * @method string getShotTimeStart()
 */
class SearchObject extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withShotTimeEnd($value)
    {
        $this->data['ShotTimeEnd'] = $value;
        $this->options['form_params']['ShotTimeEnd'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFeature($value)
    {
        $this->data['Feature'] = $value;
        $this->options['form_params']['Feature'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVendor($value)
    {
        $this->data['Vendor'] = $value;
        $this->options['form_params']['Vendor'] = $value;

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
    public function withImageContent($value)
    {
        $this->data['ImageContent'] = $value;
        $this->options['form_params']['ImageContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withObjectType($value)
    {
        $this->data['ObjectType'] = $value;
        $this->options['form_params']['ObjectType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceList($value)
    {
        $this->data['DeviceList'] = $value;
        $this->options['form_params']['DeviceList'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttributes($value)
    {
        $this->data['Attributes'] = $value;
        $this->options['form_params']['Attributes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withShotTimeStart($value)
    {
        $this->data['ShotTimeStart'] = $value;
        $this->options['form_params']['ShotTimeStart'] = $value;

        return $this;
    }
}
