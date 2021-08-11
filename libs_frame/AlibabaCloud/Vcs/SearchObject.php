<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getAlgorithmType()
 * @method string getCorpId()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getPageNumber()
 * @method string getDeviceList()
 * @method string getPicUrl()
 * @method string getImagePath()
 * @method string getPageSize()
 * @method string getObjectType()
 * @method string getConditions()
 */
class SearchObject extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlgorithmType($value)
    {
        $this->data['AlgorithmType'] = $value;
        $this->options['form_params']['AlgorithmType'] = $value;

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
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['form_params']['EndTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['form_params']['StartTime'] = $value;

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
    public function withPicUrl($value)
    {
        $this->data['PicUrl'] = $value;
        $this->options['form_params']['PicUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImagePath($value)
    {
        $this->data['ImagePath'] = $value;
        $this->options['form_params']['ImagePath'] = $value;

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
    public function withConditions($value)
    {
        $this->data['Conditions'] = $value;
        $this->options['form_params']['Conditions'] = $value;

        return $this;
    }
}
